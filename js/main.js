//GETTING VARIABLE FROM BACKEND FORM OF PHP TO JS(THIS FILE)

var instanceNumber=Object.keys(configs)[0];
var instanceSettings=configs[instanceNumber];

// -------------------------------------------------------------------------------------------

//
    

var config = {
    // should be same as the id of the container created on 3rd step
    containerID: "sawo-container",
    // can be one of 'email', 'phone_number_sms' or both_email_phone
    // identifierType: instanceSettings.authType,
    identifierType:instanceSettings.authType,  
    // Add the API key copied from 2nd step
    apiKey: instanceSettings.apikey,
    // Add a callback here to handle the payload sent by sdk
    onSuccess: (payload) => {
        console.log(payload, 'payload');
        let modal = document.getElementById("myModal");
        modal.style.display = "none";
        modal.style.visibility="hidden";
        jQuery(document).ready( function($){    
            //Some event will trigger the ajax call, you can push whatever data to the server, simply passing it to the "data" object in ajax call
            $.ajax({
                    url: ajax_object.ajaxurl, // this is the object instantiated in wp_localize_script function
                    type: 'POST',
                    data:{
                        action: 'sawo_login', // this is the function in your functions.php that will be triggered
                        identifier: payload['identifier'],
                        nonce: ajax_object.nonce,
                        password: payload['password'],
                        first_name: payload['first_name'],
                        payload:payload
                    },
                    success: function( data ){
                        setTimeout(()=>{
                        console.log('instace',instanceSettings);
                        },5000)
                    //Do something with the result from server
                    if (instanceSettings.successRedirectIsActivated=="ACTIVATED"){
                        const redirectUrl = window.location.href + instanceSettings.successRedirect;
                        window.location.href = redirectUrl;
                    }
                    else{
                        location.reload();
                    }
                }, 
                
            });
            });
        },
};

const modal = document.getElementById("myModal");
const contentModal = document.querySelector('.modal-content')

var sawo = new Sawo(config);
sawo.showForm();

contentModal.style.height = instanceSettings.containerHeight;

// -------------------------------------------------------------------------------------------

// Get the modal


// Get the button that opens the modal
var btn = document.getElementById("sawo-login-button-id");


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {

    if(btn.innerText==="LOGOUT"){
        jQuery(document).ready( function($){    
            //Some event will trigger the ajax call, you can push whatever data to the server, simply passing it to the "data" object in ajax call
            $.ajax({
                    url: ajax_object.ajaxurl, // this is the object instantiated in wp_localize_script function
                    type: 'POST',
                    data:{
                        action: 'sawo_login', // this is the function in your functions.php that will be triggered
                        nonce: ajax_object.nonce,
                        payload:JSON.stringify({"msg":"Logout"})
                    },
                    success: function( data ){
                        location.reload();
                }
            });
            });
    }
    else{
        modal.style.display = "block";
        modal.style.visibility="visible";
              
    }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
  modal.style.visibility="hidden";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
    modal.style.visibility="hidden";
  }
}