var planes=[];  
var obj = JSON.parse(data);
        for(var i in obj)
        {
      planes[i] = [obj[i].name,parseFloat(obj[i].lat),parseFloat(obj[i].lon)];
        }	 
        console.log(planes);
