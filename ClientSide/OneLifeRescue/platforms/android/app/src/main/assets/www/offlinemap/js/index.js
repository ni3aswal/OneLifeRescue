
var L = require('leaflet'),
    Router = require('./router'),
    util = require('./util'),
    extent = require('turf-extent');
    gauge = require('gauge-progress')(),
    lineDistance = require('@turf/line-distance'),
    config = require('./config');

L.Icon.Default.imagePath = 'images/';

require('leaflet.icon.glyph');
require('leaflet-routing-machine');

var map = L.map('map');

L.tileLayer('atlasName/{z}/{x}/{y}.png',
				{    maxZoom: 16  },{    minZoom: 10  }).addTo(map);

gauge.start();
var xhr = new XMLHttpRequest();
xhr.addEventListener('progress', function(oEvent) {
    if (oEvent.lengthComputable) {
        gauge.progress(oEvent.loaded, oEvent.total);
    }
});
xhr.onload = function() {
    gauge.stop();
    if (xhr.status === 200) {
        gauge.progress(100, 100);
        setTimeout(function() {
            initialize(JSON.parse(xhr.responseText));
        });
    }
    else {
        alert('Could not load routing network :( HTTP ' + xhr.status);
    }
};
xhr.open('GET', 'network.json');
xhr.send();

function initialize(network) {
    var bbox = extent(network);
    var bounds = L.latLngBounds([bbox[1], bbox[0]], [bbox[3], bbox[2]]);
    map.fitBounds(bounds);
console.log('Created1');
    L.rectangle(bounds, {color: 'orange', weight: 1, fillOpacity: 0.03, interactive: false}).addTo(map);
console.log('Created2');
    var router = new Router(network),
        control = L.Routing.control({
            createMarker: function(i, wp) {
                return L.marker(wp.latLng, {
                    icon: L.icon.glyph({ prefix: '', glyph: String.fromCharCode(65 + i) }),
                    draggable: true
                })
            },
            router: router,
            routeWhileDragging: true,
            routeDragInterval: 100
        }).addTo(map);
console.log('Created3');
    control.setWaypoints([
        [19.0419971, 72.8477183],
        [19.2419971, 72.8977183],
    ]);
console.log('Created4');
    var totalDistance = network.features.reduce(function(total, feature) {
            if (feature.geometry.type === 'LineString') {
                return total += lineDistance(feature, 'kilometers');
            } else {
                return total;
            }
        }, 0),
        graph = router._pathFinder._graph.compactedVertices,
        nodeNames = Object.keys(graph),
        totalNodes = nodeNames.length,
        totalEdges = nodeNames.reduce(function(total, nodeName) {
            return total + Object.keys(graph[nodeName]).length;
        }, 0);

    var infoContainer = document.querySelector('#info-container');
    [
        ['Total Road Length', totalDistance, 'km'],
        ['Network Nodes', totalNodes / 1000, 'k'],
        ['Network Edges', totalEdges / 1000, 'k'],
        ['Coordinates', router._points.features.length / 1000, 'k']
    ].forEach(function(info) {
        var li = L.DomUtil.create('li', '', infoContainer);
        li.innerHTML = info[0] + ': <strong>' + Math.round(info[1]) + (info[2] ? '&nbsp;' + info[2] : '') + '</strong>';
    });

    var networkLayer = L.layerGroup(),
        vertices = router._pathFinder._graph.sourceVertices,
        renderer = L.canvas().addTo(map);
    nodeNames.forEach(function(nodeName) {
        var node = graph[nodeName];
        Object.keys(node).forEach(function(neighbor) {
            var c1 = vertices[nodeName],
                c2 = vertices[neighbor];
            L.polyline([[c1[1], c1[0]], [c2[1], c2[0]]], { weight: 1, opacity: 0.4, renderer: renderer, interactive: false })
                .addTo(networkLayer)
                .bringToBack();
        });
    });

    L.control.layers(null, {
        'Routing Network': networkLayer
    }, { position: 'bottomright'}).addTo(map);
}
