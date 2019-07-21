document.addEventListener("deviceready", init, false);
function init() {
	    document.querySelector("#sendMessage").addEventListener("touchend", function() {	
		var number = 8286580965;//document.querySelector("#number").value;
		var message = document.querySelector("#message").value;
		var a= document.getElementById('chatOutput');
        //var b= document.getElementById('chatInput');
        var texts= '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p style="font-size:15px;"><b>'+message+'</b></p></div></div></div>';
        a.innerHTML=a.innerHTML + texts;
		var mess= "Query:"+message;
		console.log("going to send "+message+" to "+number);

		//simple validation for now
		if(number === '' || message === '') return;

		sms.send(number,mess,{}, function(mess) {
			console.log("success: " + message);
			navigator.notification.alert(
			    'Message to ' + number + ' has been sent.',
			    null,
			    'Message Sent',
			    'Done'
			);

		}, function(error) {
			console.log("error: " + error.code + " " + error.message);
			navigator.notification.alert(
				'Sorry, message not sent: ' + error.message,
				null,
				'Error',
				'Done'
			);
		});

	}, false);
	
	document.querySelector("#sendMessage2").addEventListener("touchend", function() {
		
		var number = 18122488341;//document.querySelector("#number").value;
		var message = document.querySelector("#message2").value;
		var a= document.getElementById('chatOutput2');
        //var b= document.getElementById('chatInput');
        var texts= '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p style="font-size:15px;"><b>'+message+'</b></p></div></div></div>';
        a.innerHTML=a.innerHTML + texts;
		var mess= message;
		console.log("going to send "+message+" to "+number);

		//simple validation for now
		if(number === '' || message === '') return;

		sms.send(number,mess,{}, function(mess) {
			console.log("success: " + message);
			navigator.notification.alert(
			    'Message to ' + number + ' has been sent.',
			    null,
			    'Message Sent',
			    'Done'
			);

		}, function(error) {
			console.log("error: " + error.code + " " + error.message);
			navigator.notification.alert(
				'Sorry, message not sent: ' + error.message,
				null,
				'Error',
				'Done'
			);
		});

	}, false);
	
}

	function receiving(){
		
	if(typeof(SMSReceive) === 'undefined') {
			// Error: plugin not installed
		alert('Not Found');
			console.warn('SMSReceive: plugin not present');
			document.getElementById('status').innerHTML = 'Error: The plugin <strong>cordova-plugin-sms-receive</strong> is not present';
		} else {
			alert('Found');
			// Initialize incoming SMS event listener
			document.addEventListener('onSMSArrive', function(e) {
				alert('Found & Active');
				if(e.data.body.includes("OLR:")){
				alert('Response From API');
				console.log('onSMSArrive()');
						var IncomingSMS = e.data;
								 var ab= document.getElementById('chatOutput');
								var texts= '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p style="font-size:15px;"><b>'+IncomingSMS.body+'</b></p></div></div></div>';
								 ab.innerHTML=ab.innerHTML+texts;
								
							  }	
							  //twilio
				else if(e.data.body.includes("OLRT:")){
					alert('Response From Twilio');
				         console.log('onSMSArriveFROMTwilio()');
				         var IncomingSMS = e.data;
				        console.log('sms.address:' + IncomingSMS.address);
						console.log('sms.body:' + IncomingSMS.body);
		                var ab= document.getElementById('chatOutput2');
                        var texts= '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p style="font-size:15px;"><b>'+IncomingSMS.body+'</b></p></div></div></div>';
						ab.innerHTML=ab.innerHTML+texts;
                      } //Reply function for other app
             else if(e.data.body.includes("Query:")){
				alert('Query received');
	           	console.log('onSMSArriveQuery()');
				var IncomingSMS = e.data;
				console.log('sms.address:' + IncomingSMS.address);
				console.log('sms.body:' + IncomingSMS.body);
/* 				document.getElementById('event').innerHTML = 'SMS from: ' + IncomingSMS.address + '<br />Service Center: ' + IncomingSMS.service_center + '<br />Received on: ' + IncomingSMS.date + '<br />Body: ' + IncomingSMS.body;
 */                
				var ab= document.getElementById('chatOutput');
                var texts= '<div class="row msg_container base_receive"><div class="col-md-10 col-xs-10"><div class="messages msg_receive"><p style="font-size:15px;"><b>'+IncomingSMS.body+'</b></p></div></div></div>';
				ab.innerHTML=ab.innerHTML+texts;

                        //calculate and send back the reply to that no.
						var msg="Calculated Reply";
						   var str = IncomingSMS.address;
						   if(str.length>10)
						 {	var co= str.length-10;
									   var res = str.substring(co,str.length);	
						 }					
			$.get("https://smsapi.engineeringtgr.com/send/", {Mobile:'8286580965',Password:'8286580965',Key:'ni3asDWUXapLuTrHoQsS',Message: msg, To:res} ,function(data) {
                          alert('SMS sent Via API');
				var ab= document.getElementById('chatOutput3');
                var texts= '<div class="row msg_container base_sent"><div class="col-md-10 col-xs-10"><div class="messages msg_sent"><p style="font-size:15px;"><b>Reply via API'+msg+'</b></p></div></div></div>';
				ab.innerHTML=ab.innerHTML+texts;
                }); 
               }
							  
			});
			 // Bind Start Watch method to button 1
				SMSReceive.startWatch(function() {
				alert('SMS Watching started');
				}, function() {
					alert('SMS Watching Failed');
				});
			
		}
	}