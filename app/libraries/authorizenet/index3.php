
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
<!DOCTYPE html>
<html>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
<head>
	<title>HostedPayment Test Page</title>
	<link href="scripts/bootstrap.min.css" rel="stylesheet">
	
</head>
<body>
	 
	<div>
		Open Authorize.Net in an iframe to complete transaction
		<button id="btnOpenAuthorizeNetIFrame" onclick="">Show Payment Form</button>
	</div>
	<div    id="iframe_holder" class="center-block" style="width:90%;max-width: 1000px">
		<iframe id="add_payment" class="embed-responsive-item panel" name="add_payment" width="100%"    frameborder="0" scrolling="auto" height="335px" hidden="true">
		</iframe>
	</div>
	<form id="send_token" action="" method="post" target="add_payment" >
		<input type="hidden" name="token" value="<?php echo $param; ?>" />
	</form>
	<script src="scripts/jquery-2.1.4.min.js"></script>
	<script src="scripts/bootstrap.min.js"></script>
<script type="text/javascript">

		$(function () {

			$("#btnOpenAuthorizeNetIFrame").click(function () {
				$("#add_payment").show();
				$("#send_token").attr({ "action": "https://test.authorize.net/payment/payment", "target": "add_payment" }).submit();
				$(window).scrollTop($('#add_payment').offset().top - 50);
			});

		});


</script>
	<script type="text/javascript">

		
		(function () {
			if (!window.CommunicationHandler ) window.CommunicationHandler  = {};
				CommunicationHandler.onReceiveCommunication = function (querystr) {
					var params = parseQueryString(querystr);
						switch (params["action"]) {
							case "successfulSave":
								break;
							case "cancel":
								break;
							case "resizeWindow":
								var w = parseInt(params["width"]);
								var h = parseInt(params["height"]);
								var ifrm = document.getElementById("add_payment");
								ifrm.style.width = w.toString() + "px";
								ifrm.style.height = h.toString() + "px";
								var newWindow = window.open(ifrm.attr(src), 'Dynamic Popup', 'height=' + ifrm.height() + ', width=' + ifrm.width() + 'scrollbars=auto, resizable=no, location=no, status=no');
								newWindow.document.write(ifrm[0].outerHTML);
								newWindow.document.close();
								break;
							case "transactResponse":
								var ifrm = document.getElementById("add_payment");
								ifrm.style.display = 'none';
							}
					};

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
</body>
</html>

   
	
	
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