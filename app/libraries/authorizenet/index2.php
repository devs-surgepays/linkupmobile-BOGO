
<?php 

	include 'config.php';
include "getHostedPaymentForm.php";
//print_r($hostedPaymentResponse);
//include 'getToken.php';

//print_r($response);

 $param = $hostedPaymentResponse->token;


//echo "<form name='dataform' id='dataform' action='https://test.authorize.net/payment/payment' method='POST' target='add_payment'>
//<input type=hidden name=token id=token value='".$param."' />
//</form>
//		  
//		  <script language='JavaScript'>
//
//			  document.dataform.submit()
//
//		  </script>
//		  ";

?>

		
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
	<link href="scripts/bootstrap.min.css" rel="stylesheet">
	<title>HostedPayment Test Page</title>
	<style type="text/css">
		body {
			margin: 0px;
			padding: 0px;
			}

		#divAuthorizeNetPopupScreen {
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 1;
			background-color: #808080;
			opacity: 0.5;
			-ms-filter: 'progid:DXImageTransform.Microsoft.Alpha(Opacity=50)';
			filter: alpha(opacity=50);
			}

		#divAuthorizeNetPopup {
			position: absolute;
			left: 50%;
			top: 50%;
			margin-left: -200px;
			margin-top: -200px;
			z-index: 2;
			overflow: visible;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupOuter {
			background-color: #dddddd;
			border-width: 1px;
			border-style: solid;
			border-color: #a0a0a0 #909090 #909090 #a0a0a0;
			padding: 4px;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupTop {
			height: 23px;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupClose {
			position: absolute;
			right: 7px;
			top: 7px;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupClose a {
			background-image: url('content/closeButton1.png');
			background-repeat: no-repeat;
			height: 16px;
			width: 16px;
			display: inline-block;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupClose a:hover {
			background-image: url('content/closeButton1h.png');
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupClose a:active {
			background-image: url('content/closeButton1a.png');
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupInner {
			background-color: #ffffff;
			border-width: 2px;
			border-style: solid;
			border-color: #cfcfcf #ebebeb #ebebeb #cfcfcf;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupBottom {
			height: 30px;
			}

		.AuthorizeNetPopupGrayFrameTheme .AuthorizeNetPopupLogo {
			position: absolute;
			right: 9px;
			bottom: 4px;
			width: 200px;
			height: 25px;
			background-image: url('content/powered_simple.png');
			}

		.AuthorizeNetPopupSimpleTheme .AuthorizeNetPopupOuter {
			border: 1px solid #585858;
			background-color: #ffffff;
			}
	</style>
</head>

<body>
	<form method="post" action="https://test.authorize.net/payment/payment" id="formAuthorizeNetPopup" name="formAuthorizeNetPopup" target="iframeAuthorizeNet" style="display:none;">
		<input type="hidden" id="popupToken" name="token" value="<?php echo $param; ?>" />
	</form>        
	<!--<input type="text" id="inputtoken" value="" />-->
	<br />
	<div>
		Trigger Accept Transaction
		<button id="btnOpenAuthorizeNetPopup" onclick="CommunicationHandler.openPopup()">Open AuthorizeNetPopup</button>
	</div>
	<div id="divAuthorizeNetPopup" style="display:none;" class="AuthorizeNetPopupGrayFrameTheme">
		<div class="AuthorizeNetPopupOuter">
			<div class="AuthorizeNetPopupTop">
				<div class="AuthorizeNetPopupClose">
					<a href="javascript:;" onclick="CommunicationHandler.closePopup();" title="Close"> </a>
				</div>
			</div>
			<div class="AuthorizeNetPopupInner">
				<iframe name="iframeAuthorizeNet" id="iframeAuthorizeNet" src="" frameborder="0" scrolling="auto"></iframe>
			</div>
			<div class="AuthorizeNetPopupBottom">
				<div class="AuthorizeNetPopupLogo" title="Powered by Authorize.Net"></div>
			</div>
			<div id="divAuthorizeNetPopupScreen" style="display:none;"></div>
		</div>
	</div>
	<script src="scripts/jquery-2.1.4.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
	<script type="text/javascript">
		(function () {
			if (!window.CommunicationHandler) window.CommunicationHandler = {};
			if (!CommunicationHandler.options) CommunicationHandler.options = {
				onPopupClosed: null
				};
			
			

			CommunicationHandler.closePopup = function () {
				document.getElementById("divAuthorizeNetPopupScreen").style.display = "none";
				document.getElementById("divAuthorizeNetPopup").style.display = "none";
				document.getElementById("iframeAuthorizeNet").src = "";
				document.getElementById("btnOpenAuthorizeNetPopup").disabled = false;
				if (CommunicationHandler.options.onPopupClosed) CommunicationHandler.options.onPopupClosed();
				};


			CommunicationHandler.openPopup = function () {
				var popup = document.getElementById("divAuthorizeNetPopup");
				var popupScreen = document.getElementById("divAuthorizeNetPopupScreen");
				var ifrm = document.getElementById("iframeAuthorizeNet");
				var form = document.forms["formAuthorizeNetPopup"];
				//$("#popupToken").val($("#inputtoken").val());
				form.action = "https://test.authorize.net/payment/payment";
				ifrm.style.width = "442px";
				ifrm.style.height = "578px";

				form.submit();

				popup.style.display = "";
				popupScreen.style.display = "";
				centerPopup();
				};

			CommunicationHandler.onReceiveCommunication = function (argument) {
					var params = parseQueryString(argument.qstr);
				console.log(params);
				console.log(params["action"]);
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
							//document.getElementById("token").value = response;
					console.log(transResponse);
							CommunicationHandler.closePopup();
							break;
						case "resizeWindow":
							var w = parseInt(params["width"]);
							var h = parseInt(params["height"]);
							var ifrm = document.getElementById("iframeAuthorizeNet");
							ifrm.style.width = w.toString() + "px";
							ifrm.style.height = h.toString() + "px";
							centerPopup();
							break;
						}
				};


			function centerPopup() {
				var d = document.getElementById("divAuthorizeNetPopup");
				d.style.left = "50%";
				d.style.top = "50%";
				var left = -Math.floor(d.clientWidth / 2);
				var top = -Math.floor(d.clientHeight / 2);
				d.style.marginLeft = left.toString() + "px";
				d.style.marginTop = top.toString() + "px";
				d.style.zIndex = "2";
				if (d.offsetLeft < 16) {
					d.style.left = "16px";
					d.style.marginLeft = "0px";
					}
				if (d.offsetTop < 16) {
					d.style.top = "16px";
					d.style.marginTop = "0px";
					}
				}

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
		}());

	</script>
   
	
	
<!--	<div id="iframe_holder" class="center-block" style="width:90%;max-width: 1000px">
	<iframe id="add_payment" class="embed-responsive-item panel" name="add_payment" width="100%"    frameborder="0" scrolling="no" hidden="true">
	</iframe>
<form name='dataform' id='dataform' action='https://test.authorize.net/payment/payment' method='POST' target='add_payment'>
<input type=hidden name=token id=token value='<?php //echo $param; ?>' />
</form>
</div>-->
	
		  <script language='JavaScript'>

			   //document.dataform.submit();
//			  
//			  window.CommunicationHandler = {};
//	function parseQueryString(str) {
//		var vars = [];
//		var arr = str.split('&');
//		var pair;
//		for (var i = 0; i < arr.length; i++) {
//			pair = arr[i].split('=');
//			vars[pair[0]] = unescape(pair[1]);
//		}
//		return vars;
//	}
//	CommunicationHandler.onReceiveCommunication = function (querystr) {
//	var params = parseQueryString(querystr);
//	switch (params['action']) {
//		case 'successfulSave':
//			break;
//		case 'cancel':
//			break;
//		case 'resizeWindow':
//			var w = parseInt(params['width']);
//			var h = parseInt(params['height']);
//			var ifrm = document.getElementById('add_payment');
//			ifrm.style.width = w.toString() +'px';
//			ifrm.style.height = h.toString() + 'px';
//			break;
//		case 'transactResponse':
//			var ifrm = document.getElementById('add_payment');
//			ifrm.style.display = 'none';
//		}
//	};  

		  </script>
</body>
</html>