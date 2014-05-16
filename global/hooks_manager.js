var hm = {};
hm.current_code_hook_type = "code"; // may be overridden by the page

hm.select_hook = function(func)
{
  var paramsHTML = "";
  var valsHTML = "";
  if (func == "")
  {
    paramsHTML = "&#8212;";  
    valsHTML = "&#8212;";  
  }
  else
  {
    var data = code_hooks[func];
    var params = code_hooks[func].params;
    for (var i=0; i<params.length; i++)
    {
      var var_string = hm.colourize(params[i]);
      paramsHTML += "<div class=\"blue\">$" + var_string + "</div>";
    }
  
    var vals = code_hooks[func].overridable;
    for (var i=0; i<vals.length; i++)
    {
      var var_string = hm.colourize(vals[i]);
      valsHTML += "<div class=\"blue\">$" + var_string + "</div>";
    }
  }
  
  $("code_hook_params").innerHTML = paramsHTML; 
  $("code_hook_overridable_values").innerHTML = valsHTML; 
}

hm.select_hook_type = function(hook_type)
{
  if (hook_type == hm.current_code_hook_type)
	  return;

  Effect.Fade($(hm.current_code_hook_type + "_hook_fields"), {duration: 0.3});
  Effect.Appear($(hook_type + "_hook_fields"), {delay: 0.4, duration: 0.3});		

	hm.current_code_hook_type = hook_type; 
}

hm.init_page = function()
{
  if (hm.current_code_hook_type == "code")
	{
	  hm.select_hook($("code_hook_dropdown").value);
	}
	
	hm.generate_custom_hook();
}

hm.add_rule_init = function()
{
  if ($("ht2").checked)
	  hm.select_hook_type('template');
  if ($("ht3").checked)
	  hm.select_hook_type('custom');

  hm.generate_custom_hook();
}

/** 
 * Helper function to colourize the variable types.
 */
hm.colourize = function(str)
{
  if (str.match(/\(array\)$/))
	  str = str.replace(/\(array\)$/, "(<span class=\"red\">array</span>)");
  if (str.match(/\(hash\)$/))
	  str = str.replace(/\(hash\)$/, "(<span class=\"orange\">hash</span>)");
  if (str.match(/\(string\)$/))
	  str = str.replace(/\(string\)$/, "(<span class=\"green\">string</span>)");
  if (str.match(/\(boolean\)$/))
	  str = str.replace(/\(boolean\)$/, "(<span class=\"burgundy\">boolean</span>)");
  if (str.match(/\(integer\)$/))
	  str = str.replace(/\(integer\)$/, "(<span class=\"light_green\">integer</span>)");
		
	return str;
}

hm.generate_custom_hook = function()
{
  var custom_hook_name = $("custom_hook").value;
	
	var str = "&#8212;";
	if (custom_hook_name) 
	  str = "{template_hook location=\"" + $("custom_hook").value + "\"}";

	$("custom_hook_smarty_code").innerHTML = str;
}