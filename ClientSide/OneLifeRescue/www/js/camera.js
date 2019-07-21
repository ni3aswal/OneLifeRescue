var camm = {
	image: null,
	imgOptions:null,
	callCamera: function ( ) {
		console.log("Camera on");
		camm.image = document.querySelector("#image");
		alert("ON");
		camm.imgOptions = {quality : 100,
				destinationType: Camera.DestinationType.DATA_URL,
  				sourceType: Camera.PictureSourceType.CAMERA,
				allowEdit : false,
				encodingType : Camera.EncodingType.JPEG,
				mediaType: Camera.MediaType.PICTURE,
				targetWidth : 200,
				cameraDirection : Camera.Direction.FRONT,
				saveToPhotoAlbum : true
			   };
        navigator.camera.getPicture( camm.imgSuccess, camm.imgFail, camm.imgOptions );
    },
	imgSuccess: function ( imageData ) {
   		camm.image.src = "data:image/jpeg;base64," + imageData;
		console.log("Image loaded into interface");
		navigator.camera.cleanup();
	},
	imgFail: function ( msg ) {
		console.log("Failed to get image: " +  msg);
	}
};