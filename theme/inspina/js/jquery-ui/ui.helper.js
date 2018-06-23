function treatDataForErrors(data)
{
	if( data!= null)
       if((data.code != null)&&(data.code != ""))
       {
          if(data.code > 0)
              alert(data.msg);
      }
  }

  function fixSearchOperators(identifier)
  {
    if (!identifier) {
      identifier = "#list";
    }

    var columns = $(identifier).jqGrid ('getGridParam', 'colModel');
    var gridContainer = $(identifier).parents(".ui-jqgrid");
    var filterToolbar = $("tr.ui-search-toolbar", gridContainer);

    filterToolbar.find("th").each(function()
    {
        var index = $(this).index();
        if(!(columns[index].searchoptions &&
           columns[index].searchoptions.sopt &&
           columns[index].searchoptions.sopt.length>1))
        {
            $(this).find(".ui-search-oper").hide();
        }
    });
}

function treatServerErrors(msg)
{
	console.log("Eroare server: " + msg);
}

function showPermanentMessage(code, msg)
{
    if(code == 0)
    {
      showPermanentSuccess(msg);
  }
  else 
  {
      showError(msg);
  }
}

function showMessage(code, msg)
{
	if(code == 0)
	{
		showSuccess(msg);
	}
	else 
	{
		showError(msg);
	}
}

function showSuccess(msg)
{
  toastr.clear();
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "preventDuplicates": true,
    "positionClass": "toast-top-right",
    "timeOut": "2000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  toastr.success(msg);
}

function showPermanentSuccess(msg)
{
	if ($("#msg")){
     $("#msg").remove();
 }
 var content = '<div id="msg" class=\"ui-widget\">' +
 '<div class=\"ui-state-highlight ui-corner-all\" style=\"padding: 0 .7em;\">' + 
 '<p><span class=\"ui-icon ui-icon-check\" style=\"float: left; margin-right: .3em;\"><\/span>' +
 '<strong>Success: <\/strong>' + msg +  '<\/p>' +
 '<\/div><br/>'+
 '<\/div>';
 
 $("body").prepend(content);
}

function showError(msg)
{
  toastr.clear();
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "preventDuplicates": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  toastr.error(msg);
}

function showLoading()
{
  toastr.clear();
  toastr.options = {
    "closeButton": true,
    "preventDuplicates": true,
    "positionClass": "toast-top-right",
    "timeOut": "0",
    "extendedTimeOut": "0"
  };
  toastr.warning("Processing...");
}

function showLoadingMessage(msg)
{
  toastr.clear();
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "preventDuplicates": true,
    "positionClass": "toast-top-right",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
  };
  toastr.warning(msg);
}

function showMessagePermanent(title, msg)
{
    var content =  '<div id="dialog-message" style="display:none;" title="'+title+'">' +
    '<div id="div_success_msg" class="ui-widget">' +
    '<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">' +
    '<p>' +
    '<span class="ui-icon ui-icon-check" style="float: left; margin-right: .3em;"></span>' +
    '<strong>Success: </strong>' +
    '<label id="info_msg" style="color: black; line-height: 20px;" >'+msg+'</label>' + 
    '</p>' +				
    '</div>' +
    '</div>' +
    '</div>';
    
    $("body").prepend(content);
    
    $("#dialog:ui-dialog").show();
    $("#dialog-message").dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog("close");
                jQuery("#list").trigger("reloadGrid");
            }
        }
    });     
}

function showMessageWarning(title, msg)
{
    var content =  '<div id="dialog-message" style="display:none;" title="'+title+'">' +
    '<div id="div_error_msg" class="ui-widget">' +
    '<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">' +
    '<p>' +
    '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>' +
    '<strong>Error: </strong>' +
    '<label id="error_msg" style="color: black; line-height: 20px;" >'+msg+'</label>' + 
    '</p>' +				
    '</div>' +
    '</div>' +
    '</div>';
    
    $("body").prepend(content);
    
    $("#dialog:ui-dialog").show();
    $("#dialog-message").dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog("close");
                jQuery("#list").trigger("reloadGrid");
            }
        }
    });
}

function showMessageDialog(code, msg)
{
	if(code == 0)
	{
		showSuccessMessageDialog(msg);
	}
	else 
	{
		showErrorMessageDialog(msg);
	}
}

function showSuccessMessageDialog(msg)
{
    var content =   '<div id="dialog-message" style="display:none;" title="Succes">' +
    '<div id="msg" class="ui-widget">' +
    '<div class="ui-state-highlight ui-corner-all" style="padding: 0 .7em;">' + 
    '<p>'+
    '<span class="ui-icon ui-icon-check" style="float: left; margin-right: .3em;"></span>' +
    '<strong>Success: </strong>' + msg +  
    '</p>' +
    '</div>' +
    '<br/>' +
    '</div>'+
    '</div>';
    
    $("body").prepend(content);
    
    $("#dialog:ui-dialog").show();
    $("#dialog-message").dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog("close");
            }
        }
    });
}

function showErrorMessageDialog(msg)
{
    var content =   '<div id="dialog-message" style="display:none;" title="Eroare">' +
    '<div id="msg" class="ui-widget">' +
    '<div class="ui-state-error ui-corner-all" style="padding: 0 .7em;">' + 
    '<p>' +
    '<span class="ui-icon ui-icon-alert" style="float: left; margin-right: .3em;"></span>' +
    '<strong>Error: </strong>' + msg +  
    '</p>' +
    '</div>'+
    '</br>'+
    '</div>'+
    '</div>';
    
    $("body").prepend(content);
    
    $("#dialog:ui-dialog").show();
    $("#dialog-message").dialog({
        modal: true,
        buttons: {
            Ok: function() {
                $(this).dialog("close");
            }
        }
    });
}
