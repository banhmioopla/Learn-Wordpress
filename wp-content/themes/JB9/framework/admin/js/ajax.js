function AjaxRequest()
{
	this.mRequest = this.getHttpRequest();
	this.mHandlers = new Array();
	var self = this;
	
	this.mRequest.onreadystatechange = function()
	{
		if(	self.mHandlers[ self.mRequest.readyState ] != undefined )
		{
			for( i = 0 ; i < self.mHandlers[ self.mRequest.readyState ].length ; i++ )
			{
				self.mHandlers[ self.mRequest.readyState ][ i ]( self );				
			}
		}
	}
}
function ajax_validateexpiry(e, id) {
    jQuery.ajax({
        type: "POST",  
		url: ''+ e +'',	
        data: {
            action: "validateexpiry",
            pid: id,
        },
        success: function(e) {
           
        },
        error: function(e) {
             
        }
    })
}
AjaxRequest.prototype.addEventListener = function( pEventType, pFunction )
{
	if(	this.mHandlers[ pEventType ] == undefined )
	{
		this.mHandlers[ pEventType ] = new Array();
	}
	
	this.mHandlers[ pEventType ].push( pFunction );
}

AjaxRequest.prototype.getHttpRequest = function()
{
	// List of Microsoft XMLHTTP versions - newest first

	var MSXML_XMLHTTP_PROGIDS = new Array
	(
		'MSXML2.XMLHTTP.5.0',
		'MSXML2.XMLHTTP.4.0',
		'MSXML2.XMLHTTP.3.0',
		'MSXML2.XMLHTTP',
		'Microsoft.XMLHTTP'
	);

	// Do we support the request natively (eg, Mozilla, Opera, Safari, Konqueror)

	if( window.XMLHttpRequest != null )
	{
		return new XMLHttpRequest();
	}
	else
	{
		// Look for a supported IE version

		for( i = 0 ; MSXML_XMLHTTP_PROGIDS.length > i ; i++ )
		{
			try
			{
				return new ActiveXObject( MSXML_XMLHTTP_PROGIDS[ i ] );
			}
			catch( e )
			{
			}
		}
	}
	
	return( null );
}

function AjaxGo( fileName, div )
{
	var Ajax = new AjaxRequest();

	if( Ajax.mRequest )
	{				
		Ajax.mFileName 	= fileName;		
		var obj = document.getElementById(div);				

		Ajax.mRequest.open( "GET", fileName);
		Ajax.mRequest.onreadystatechange = function() {
			if(Ajax.mRequest.readyState == 4 && Ajax.mRequest.status == 200){
				obj.innerHTML = Ajax.mRequest.responseText;
			}
		}		
	}
	Ajax.mRequest.send( null );
}

  /* =============================================================================
  CUSTOM
   ========================================================================== */

function WLTCatPrice(e, t, a) {
    CoreDo(e + "/?core_aj=1&action=CatPrice&cid=" + t, a)
}
function WLTCatPriceUpdate(e, t, a, o) {
    CoreDo(e + "/?core_aj=1&action=CatUpdatePrice&cid=" + t + "&p=" + a, o)
}
function CoreDo(e, t) {
    var a = new AjaxRequest;
    if (a.mRequest) {
        "https:" == document.location.protocol ? e.indexOf("https:") > -1 || (e = "https://" + e) : e = "http://" + e, a.mFileName = e;
        var o = document.getElementById(t);
        a.mRequest.open("GET", e), a.mRequest.onreadystatechange = function() {
            4 == a.mRequest.readyState && 200 == a.mRequest.status && (o.innerHTML = a.mRequest.responseText)
        }
    }
    a.mRequest.send(null)
}
 