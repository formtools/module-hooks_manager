var hm = {};
hm.current_code_hook_type = "code"; // may be overridden by the page

hm.select_hook = function(field) {
  var value = field.value;

  var paramsHTML = "";
  var valsHTML = "";
  if (value === "") {
    paramsHTML = "&#8212;";
    valsHTML   = "&#8212;";
  } else {
    var selectedOption = $(field).find(":selected");
    var index = selectedOption.data("index");
    var file = selectedOption.closest("optgroup").attr("label");
    var data = code_hooks[file][index];

    var params = data.params.split(',');
    for (var i=0; i<params.length; i++) {
      paramsHTML += "<div class=\"blue\">$" + params[i] + "</div>";
    }
    var vals = data.overridable.split(',');
    for (var i=0; i<vals.length; i++) {
      valsHTML += "<div class=\"blue\">$" + vals[i] + "</div>";
    }
  }

  $("#code_hook_params").html(paramsHTML);
  $("#code_hook_overridable_values").html(valsHTML);
};


hm.select_hook_type = function(hook_type) {
  if (hook_type == hm.current_code_hook_type) {
	  return;
  }
  $("#" + hm.current_code_hook_type + "_hook_fields").hide();
  $("#" + hook_type + "_hook_fields").show();
	hm.current_code_hook_type = hook_type;

	if (hook_type === 'template') {
	  template_html_editor.refresh();
  } else if (hook_type === 'custom') {
    custom_html_editor.refresh();
  } else {
    html_editor.refresh();
  }
};

hm.generate_custom_hook = function() {
  var custom_hook_name = $("#custom_hook").val();
  var str = "&#8212;";
  if (custom_hook_name) {
    str = "{template_hook location=\"" + $("#custom_hook").val() + "\"}";
  }
  $("#custom_hook_smarty_code").html(str);
};

hm.init_page = function() {
  if (hm.current_code_hook_type == "code") {
	  hm.select_hook($("#code_hook_dropdown")[0]);
	}
	hm.generate_custom_hook();

  $("input[name=hook_type]").bind("change", function() {
    hm.select_hook_type(this.value);
  });
  $("input[name=template_hook_code_type]").bind("change", function () {
    hm.setMode(template_html_editor, this.value);
  });
  $("input[name=custom_hook_code_type]").bind("change", function () {
    hm.setMode(custom_html_editor, this.value);
  });

  hm.setMode(template_html_editor, $("input[name=template_hook_code_type]:checked").val());
  hm.setMode(custom_html_editor, $("input[name=custom_hook_code_type]:checked").val());

  // trigger the select hook option. That ensures the
  if (hm.current_code_hook_type === 'code') {
    hm.select_hook(document.getElementById('code_hook_dropdown'));
  }
};


hm.setMode = function(editor, value) {
  var map = {
    html: 'xml',
    php: 'text/x-php',
    smarty: 'smarty'
  };
  editor.setOption('mode', map[value]);
};
