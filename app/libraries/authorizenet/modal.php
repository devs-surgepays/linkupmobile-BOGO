
<div class="modal fade" id="authorize-Modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Authorize.Net</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="https://test.authorize.net/payment/payment" id="formAuthorizeNetPopup" name="formAuthorizeNetPopup" target="iframeAuthorizeNet" style="display:none;">
		<input type="hidden" id="popupToken" name="token" value="" />
	</form>        
	<!--<input type="text" id="inputtoken" value="" />-->
	<div class="iframe-container">
	<iframe name="iframeAuthorizeNet" id="iframeAuthorizeNet" src="" overflow-x='hidden' frameborder="0" scrolling="auto"></iframe>
		  </div>
      </div>

    </div>
  </div>
</div>
<style>
.iframe-container {
    overflow: hidden;
    padding-top: 56.25%;
    position: relative;
  background:url(https://surgephone.secure-order-forms.com/checkout3/assets/img/ajax_loader_gray_256.gif) center center no-repeat;

}
	.iframe-container iframe {
   border: 0;
   height: 100%;
   left: 0;
   position: absolute;
   top: 0;
   width: 100%;
}
	@media(max-width:1024px){
		.iframe-container{
			height: 75vh;
		}
		.modal-lg{
			 max-width: 100%;
    margin: 1rem;
		}
		#authorize-Modal{
			padding-right: 0 !important;
		}
	}
</style>
<script  type="text/javascript">
	(function () {
		
		
			if (!window.CommunicationHandler) window.CommunicationHandler = {};
			if (!CommunicationHandler.options) CommunicationHandler.options = {
				onPopupClosed: null
				};
			window.CommunicationHandler = {};
			
		

			CommunicationHandler.closePopup = function () {
				//document.getElementById("divAuthorizeNetPopupScreen").style.display = "none";
//				document.getElementById("divAuthorizeNetPopup").style.display = "none";
				
				$(".iframe-container").hide();
				//document.getElementById("btnOpenAuthorizeNetPopup").disabled = false;
				if (CommunicationHandler.options.onPopupClosed) CommunicationHandler.options.onPopupClosed();
				};


			//CommunicationHandler.openPopup = function () {
//				var popup = document.getElementById("divAuthorizeNetPopup");
//				var popupScreen = document.getElementById("divAuthorizeNetPopupScreen");
//				var ifrm = document.getElementById("iframeAuthorizeNet");
//				var form = document.forms["formAuthorizeNetPopup"];
//				$("#popupToken").val($("#inputtoken").val());
//				form.action = "https://test.authorize.net/payment/payment";
//				ifrm.style.width = "442px";
//				ifrm.style.height = "578px";
//
//				form.submit();
//
//				popup.style.display = "";
//				popupScreen.style.display = "";
//				centerPopup();
//				};
		
		function parseQueryString(str) {
					var vars = [];
					var arr = str.split('&');
					var pair;
					for (var i = 0; i < arr.length; i++) {
						pair = arr[i].split('=');
						vars.push(pair[0]);
						vars[pair[0]] = unescape(pair[1]);
					}
					return vars;
				}

			CommunicationHandler.onReceiveCommunication = function (argument) {
					var params = parseQueryString(argument.qstr);
					var cnum = $("#cardNum").val();
				
					switch (params["action"]) {
						case "successfulSave":
							CommunicationHandler.closePopup();
							break;
						case "cancel":
							CommunicationHandler.closePopup();
							break;
						case "transactResponse":
							var response = params["response"];
							var transResponse = JSON.parse(params['response']);
							var pmtstatus = "";
							//document.getElementById("token").value = response;
							console.log(transResponse);
							if(transResponse.responseCode==1){
							$(".modal-body").html('<div class="alert alert-success" role="alert">This transaction has been approved.</div>');
									pmtstatus = "This transaction has been approved.";
								}else{
								$(".modal-body").html('<div class="alert alert-danger" role="alert">This transaction has been declined.</div>');
									pmtstatus = "This transaction has been declined.";
								}
							
							var rescode = transResponse.responseCode;
							var transid = transResponse.transId;
							var confirmation_id = transResponse.poNumber;
								
								$.ajax({
									  data:  {pmtstatus:pmtstatus,rescode:rescode,transid:transid,confirmation_id:confirmation_id,cardNum:cardNum},
									  url:   'authorizenet/data_info.php',
									  type:  'post',
									  success:  function (data) {
									  			var myObj = JSON.parse(data);
										  console.log(myObj);
										  	if(myObj.update =="1" && myObj.success =="ok"){
												console.log("entro");
											
												document.getElementById("data-form").submit();
														
												  }
											}
										  

									 });
							CommunicationHandler.closePopup();
							break;
						case "resizeWindow":
							//var w = parseInt(params["width"]);
//							var h = parseInt(params["height"]);
//							var ifrm = document.getElementById("iframeAuthorizeNet");
							//ifrm.style.width = w.toString() + "px";
							//ifrm.style.height = h.toString() + "px";
							//centerPopup();
							break;
						}
				};


			//function centerPopup() {
//				var d = document.getElementById("divAuthorizeNetPopup");
//				d.style.left = "50%";
//				d.style.top = "50%";
//				var left = -Math.floor(d.clientWidth / 2);
//				var top = -Math.floor(d.clientHeight / 2);
//				d.style.marginLeft = left.toString() + "px";
//				d.style.marginTop = top.toString() + "px";
//				d.style.zIndex = "2";
//				if (d.offsetLeft < 16) {
//					d.style.left = "16px";
//					d.style.marginLeft = "0px";
//					}
//				if (d.offsetTop < 16) {
//					d.style.top = "16px";
//					d.style.marginTop = "0px";
//					}
//				}

			
		}());
</script>