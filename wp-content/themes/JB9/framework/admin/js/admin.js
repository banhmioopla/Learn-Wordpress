(function(){var SelectParser;SelectParser=function(){function SelectParser(){this.options_index=0,this.parsed=[]}return SelectParser.prototype.add_node=function(child){return child.nodeName.toUpperCase()==="OPTGROUP"?this.add_group(child):this.add_option(child)},SelectParser.prototype.add_group=function(group){var group_position,option,_i,_len,_ref,_results;group_position=this.parsed.length,this.parsed.push({array_index:group_position,group:!0,label:group.label,children:0,disabled:group.disabled}),_ref=group.childNodes,_results=[];for(_i=0,_len=_ref.length;_i<_len;_i++)option=_ref[_i],_results.push(this.add_option(option,group_position,group.disabled));return _results},SelectParser.prototype.add_option=function(option,group_position,group_disabled){if(option.nodeName.toUpperCase()==="OPTION")return option.text!==""?(group_position!=null&&(this.parsed[group_position].children+=1),this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,value:option.value,text:option.text,html:option.innerHTML,selected:option.selected,disabled:group_disabled===!0?group_disabled:option.disabled,group_array_index:group_position,classes:option.className,style:option.style.cssText})):this.parsed.push({array_index:this.parsed.length,options_index:this.options_index,empty:!0}),this.options_index+=1},SelectParser}(),SelectParser.select_to_array=function(select){var child,parser,_i,_len,_ref;parser=new SelectParser,_ref=select.childNodes;for(_i=0,_len=_ref.length;_i<_len;_i++)child=_ref[_i],parser.add_node(child);return parser.parsed},this.SelectParser=SelectParser}).call(this),function(){var AbstractChosen,root;root=this,AbstractChosen=function(){function AbstractChosen(form_field,options){this.form_field=form_field,this.options=options!=null?options:{},this.set_default_values(),this.is_multiple=this.form_field.multiple,this.set_default_text(),this.setup(),this.set_up_html(),this.register_observers(),this.finish_setup()}return AbstractChosen.prototype.set_default_values=function(){var _this=this;return this.click_test_action=function(evt){return _this.test_active_click(evt)},this.activate_action=function(evt){return _this.activate_field(evt)},this.active_field=!1,this.mouse_on_container=!1,this.results_showing=!1,this.result_highlighted=null,this.result_single_selected=null,this.allow_single_deselect=this.options.allow_single_deselect!=null&&this.form_field.options[0]!=null&&this.form_field.options[0].text===""?this.options.allow_single_deselect:!1,this.disable_search_threshold=this.options.disable_search_threshold||0,this.disable_search=this.options.disable_search||!1,this.search_contains=this.options.search_contains||!1,this.choices=0,this.single_backstroke_delete=this.options.single_backstroke_delete||!1,this.max_selected_options=this.options.max_selected_options||Infinity},AbstractChosen.prototype.set_default_text=function(){return this.form_field.getAttribute("data-placeholder")?this.default_text=this.form_field.getAttribute("data-placeholder"):this.is_multiple?this.default_text=this.options.placeholder_text_multiple||this.options.placeholder_text||"Select Some Options":this.default_text=this.options.placeholder_text_single||this.options.placeholder_text||"Select an Option",this.results_none_found=this.form_field.getAttribute("data-no_results_text")||this.options.no_results_text||"No results match"},AbstractChosen.prototype.mouse_enter=function(){return this.mouse_on_container=!0},AbstractChosen.prototype.mouse_leave=function(){return this.mouse_on_container=!1},AbstractChosen.prototype.input_focus=function(evt){var _this=this;if(!this.active_field)return setTimeout(function(){return _this.container_mousedown()},50)},AbstractChosen.prototype.input_blur=function(evt){var _this=this;if(!this.mouse_on_container)return this.active_field=!1,setTimeout(function(){return _this.blur_test()},100)},AbstractChosen.prototype.result_add_option=function(option){var classes,style;return option.disabled?"":(option.dom_id=this.container_id+"_o_"+option.array_index,classes=option.selected&&this.is_multiple?[]:["active-result"],option.selected&&classes.push("result-selected"),option.group_array_index!=null&&classes.push("group-option"),option.classes!==""&&classes.push(option.classes),style=option.style.cssText!==""?' style="'+option.style+'"':"",'<li id="'+option.dom_id+'" class="'+classes.join(" ")+'"'+style+">"+option.html+"</li>")},AbstractChosen.prototype.results_update_field=function(){return this.is_multiple||this.results_reset_cleanup(),this.result_clear_highlight(),this.result_single_selected=null,this.results_build()},AbstractChosen.prototype.results_toggle=function(){return this.results_showing?this.results_hide():this.results_show()},AbstractChosen.prototype.results_search=function(evt){return this.results_showing?this.winnow_results():this.results_show()},AbstractChosen.prototype.keyup_checker=function(evt){var stroke,_ref;stroke=(_ref=evt.which)!=null?_ref:evt.keyCode,this.search_field_scale();switch(stroke){case 8:if(this.is_multiple&&this.backstroke_length<1&&this.choices>0)return this.keydown_backstroke();if(!this.pending_backstroke)return this.result_clear_highlight(),this.results_search();break;case 13:evt.preventDefault();if(this.results_showing)return this.result_select(evt);break;case 27:return this.results_showing&&this.results_hide(),!0;case 9:case 38:case 40:case 16:case 91:case 17:break;default:return this.results_search()}},AbstractChosen.prototype.generate_field_id=function(){var new_id;return new_id=this.generate_random_id(),this.form_field.id=new_id,new_id},AbstractChosen.prototype.generate_random_char=function(){var chars,newchar,rand;return chars="0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ",rand=Math.floor(Math.random()*chars.length),newchar=chars.substring(rand,rand+1)},AbstractChosen}(),root.AbstractChosen=AbstractChosen}.call(this),function(){var $,Chosen,get_side_border_padding,root,__hasProp=Object.prototype.hasOwnProperty,__extends=function(child,parent){function ctor(){this.constructor=child}for(var key in parent)__hasProp.call(parent,key)&&(child[key]=parent[key]);return ctor.prototype=parent.prototype,child.prototype=new ctor,child.__super__=parent.prototype,child};root=this,$=jQuery,$.fn.extend({chosen:function(options){return $.browser.msie&&($.browser.version==="6.0"||$.browser.version==="7.0"&&document.documentMode===7)?this:this.each(function(input_field){var $this;$this=$(this);if(!$this.hasClass("chzn-done"))return $this.data("chosen",new Chosen(this,options))})}}),Chosen=function(_super){function Chosen(){Chosen.__super__.constructor.apply(this,arguments)}return __extends(Chosen,_super),Chosen.prototype.setup=function(){return this.form_field_jq=$(this.form_field),this.current_value=this.form_field_jq.val(),this.is_rtl=this.form_field_jq.hasClass("chzn-rtl")},Chosen.prototype.finish_setup=function(){return this.form_field_jq.addClass("chzn-done")},Chosen.prototype.set_up_html=function(){var container_div,dd_top,dd_width,sf_width;return this.container_id=this.form_field.id.length?this.form_field.id.replace(/[^\w]/g,"_"):this.generate_field_id(),this.container_id+="_chzn",this.f_width=this.form_field_jq.outerWidth(),container_div=$("<div />",{id:this.container_id,"class":"chzn-container"+(this.is_rtl?" chzn-rtl":""),style:"width: "+this.f_width+"px;"}),this.is_multiple?container_div.html('<ul class="chzn-choices"><li class="search-field"><input type="text" value="'+this.default_text+'" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chzn-drop" style="left:-9000px;"><ul class="chzn-results"></ul></div>'):container_div.html('<a href="javascript:void(0)" class="chzn-single chzn-default"><span>'+this.default_text+'</span><div><b></b></div></a><div class="chzn-drop" style="left:-9000px;"><div class="chzn-search"><input type="text" autocomplete="off" /></div><ul class="chzn-results"></ul></div>'),this.form_field_jq.hide().after(container_div),this.container=$("#"+this.container_id),this.container.addClass("chzn-container-"+(this.is_multiple?"multi":"single")),this.dropdown=this.container.find("div.chzn-drop").first(),dd_top=this.container.height(),dd_width=this.f_width-get_side_border_padding(this.dropdown),this.dropdown.css({width:dd_width+"px",top:dd_top+"px"}),this.search_field=this.container.find("input").first(),this.search_results=this.container.find("ul.chzn-results").first(),this.search_field_scale(),this.search_no_results=this.container.find("li.no-results").first(),this.is_multiple?(this.search_choices=this.container.find("ul.chzn-choices").first(),this.search_container=this.container.find("li.search-field").first()):(this.search_container=this.container.find("div.chzn-search").first(),this.selected_item=this.container.find(".chzn-single").first(),sf_width=dd_width-get_side_border_padding(this.search_container)-get_side_border_padding(this.search_field),this.search_field.css({width:sf_width+"px"})),this.results_build(),this.set_tab_index(),this.form_field_jq.trigger("liszt:ready",{chosen:this})},Chosen.prototype.register_observers=function(){var _this=this;return this.container.mousedown(function(evt){return _this.container_mousedown(evt)}),this.container.mouseup(function(evt){return _this.container_mouseup(evt)}),this.container.mouseenter(function(evt){return _this.mouse_enter(evt)}),this.container.mouseleave(function(evt){return _this.mouse_leave(evt)}),this.search_results.mouseup(function(evt){return _this.search_results_mouseup(evt)}),this.search_results.mouseover(function(evt){return _this.search_results_mouseover(evt)}),this.search_results.mouseout(function(evt){return _this.search_results_mouseout(evt)}),this.form_field_jq.bind("liszt:updated",function(evt){return _this.results_update_field(evt)}),this.form_field_jq.bind("liszt:activate",function(evt){return _this.activate_field(evt)}),this.form_field_jq.bind("liszt:open",function(evt){return _this.container_mousedown(evt)}),this.search_field.blur(function(evt){return _this.input_blur(evt)}),this.search_field.keyup(function(evt){return _this.keyup_checker(evt)}),this.search_field.keydown(function(evt){return _this.keydown_checker(evt)}),this.is_multiple?(this.search_choices.click(function(evt){return _this.choices_click(evt)}),this.search_field.focus(function(evt){return _this.input_focus(evt)})):this.container.click(function(evt){return evt.preventDefault()})},Chosen.prototype.search_field_disabled=function(){this.is_disabled=this.form_field_jq[0].disabled;if(this.is_disabled)return this.container.addClass("chzn-disabled"),this.search_field[0].disabled=!0,this.is_multiple||this.selected_item.unbind("focus",this.activate_action),this.close_field();this.container.removeClass("chzn-disabled"),this.search_field[0].disabled=!1;if(!this.is_multiple)return this.selected_item.bind("focus",this.activate_action)},Chosen.prototype.container_mousedown=function(evt){var target_closelink;if(!this.is_disabled)return target_closelink=evt!=null?$(evt.target).hasClass("search-choice-close"):!1,evt&&evt.type==="mousedown"&&!this.results_showing&&evt.stopPropagation(),!this.pending_destroy_click&&!target_closelink?(this.active_field?!this.is_multiple&&evt&&($(evt.target)[0]===this.selected_item[0]||$(evt.target).parents("a.chzn-single").length)&&(evt.preventDefault(),this.results_toggle()):(this.is_multiple&&this.search_field.val(""),$(document).click(this.click_test_action),this.results_show()),this.activate_field()):this.pending_destroy_click=!1},Chosen.prototype.container_mouseup=function(evt){if(evt.target.nodeName==="ABBR"&&!this.is_disabled)return this.results_reset(evt)},Chosen.prototype.blur_test=function(evt){if(!this.active_field&&this.container.hasClass("chzn-container-active"))return this.close_field()},Chosen.prototype.close_field=function(){return $(document).unbind("click",this.click_test_action),this.is_multiple||(this.selected_item.attr("tabindex",this.search_field.attr("tabindex")),this.search_field.attr("tabindex",-1)),this.active_field=!1,this.results_hide(),this.container.removeClass("chzn-container-active"),this.winnow_results_clear(),this.clear_backstroke(),this.show_search_field_default(),this.search_field_scale()},Chosen.prototype.activate_field=function(){return!this.is_multiple&&!this.active_field&&(this.search_field.attr("tabindex",this.selected_item.attr("tabindex")),this.selected_item.attr("tabindex",-1)),this.container.addClass("chzn-container-active"),this.active_field=!0,this.search_field.val(this.search_field.val()),this.search_field.focus()},Chosen.prototype.test_active_click=function(evt){return $(evt.target).parents("#"+this.container_id).length?this.active_field=!0:this.close_field()},Chosen.prototype.results_build=function(){var content,data,_i,_len,_ref;this.parsing=!0,this.results_data=root.SelectParser.select_to_array(this.form_field),this.is_multiple&&this.choices>0?(this.search_choices.find("li.search-choice").remove(),this.choices=0):this.is_multiple||(this.selected_item.addClass("chzn-default").find("span").text(this.default_text),this.disable_search||this.form_field.options.length<=this.disable_search_threshold?this.container.addClass("chzn-container-single-nosearch"):this.container.removeClass("chzn-container-single-nosearch")),content="",_ref=this.results_data;for(_i=0,_len=_ref.length;_i<_len;_i++)data=_ref[_i],data.group?content+=this.result_add_group(data):data.empty||(content+=this.result_add_option(data),data.selected&&this.is_multiple?this.choice_build(data):data.selected&&!this.is_multiple&&(this.selected_item.removeClass("chzn-default").find("span").text(data.text),this.allow_single_deselect&&this.single_deselect_control_build()));return this.search_field_disabled(),this.show_search_field_default(),this.search_field_scale(),this.search_results.html(content),this.parsing=!1},Chosen.prototype.result_add_group=function(group){return group.disabled?"":(group.dom_id=this.container_id+"_g_"+group.array_index,'<li id="'+group.dom_id+'" class="group-result">'+$("<div />").text(group.label).html()+"</li>")},Chosen.prototype.result_do_highlight=function(el){var high_bottom,high_top,maxHeight,visible_bottom,visible_top;if(el.length){this.result_clear_highlight(),this.result_highlight=el,this.result_highlight.addClass("highlighted"),maxHeight=parseInt(this.search_results.css("maxHeight"),10),visible_top=this.search_results.scrollTop(),visible_bottom=maxHeight+visible_top,high_top=this.result_highlight.position().top+this.search_results.scrollTop(),high_bottom=high_top+this.result_highlight.outerHeight();if(high_bottom>=visible_bottom)return this.search_results.scrollTop(high_bottom-maxHeight>0?high_bottom-maxHeight:0);if(high_top<visible_top)return this.search_results.scrollTop(high_top)}},Chosen.prototype.result_clear_highlight=function(){return this.result_highlight&&this.result_highlight.removeClass("highlighted"),this.result_highlight=null},Chosen.prototype.results_show=function(){var dd_top;if(!this.is_multiple)this.selected_item.addClass("chzn-single-with-drop"),this.result_single_selected&&this.result_do_highlight(this.result_single_selected);else if(this.max_selected_options<=this.choices)return this.form_field_jq.trigger("liszt:maxselected",{chosen:this}),!1;return dd_top=this.is_multiple?this.container.height():this.container.height()-1,this.form_field_jq.trigger("liszt:showing_dropdown",{chosen:this}),this.dropdown.css({top:dd_top+"px",left:0}),this.results_showing=!0,this.search_field.focus(),this.search_field.val(this.search_field.val()),this.winnow_results()},Chosen.prototype.results_hide=function(){return this.is_multiple||this.selected_item.removeClass("chzn-single-with-drop"),this.result_clear_highlight(),this.form_field_jq.trigger("liszt:hiding_dropdown",{chosen:this}),this.dropdown.css({left:"-9000px"}),this.results_showing=!1},Chosen.prototype.set_tab_index=function(el){var ti;if(this.form_field_jq.attr("tabindex"))return ti=this.form_field_jq.attr("tabindex"),this.form_field_jq.attr("tabindex",-1),this.is_multiple?this.search_field.attr("tabindex",ti):(this.selected_item.attr("tabindex",ti),this.search_field.attr("tabindex",-1))},Chosen.prototype.show_search_field_default=function(){return this.is_multiple&&this.choices<1&&!this.active_field?(this.search_field.val(this.default_text),this.search_field.addClass("default")):(this.search_field.val(""),this.search_field.removeClass("default"))},Chosen.prototype.search_results_mouseup=function(evt){var target;target=$(evt.target).hasClass("active-result")?$(evt.target):$(evt.target).parents(".active-result").first();if(target.length)return this.result_highlight=target,this.result_select(evt)},Chosen.prototype.search_results_mouseover=function(evt){var target;target=$(evt.target).hasClass("active-result")?$(evt.target):$(evt.target).parents(".active-result").first();if(target)return this.result_do_highlight(target)},Chosen.prototype.search_results_mouseout=function(evt){if($(evt.target).hasClass("active-result"))return this.result_clear_highlight()},Chosen.prototype.choices_click=function(evt){evt.preventDefault();if(this.active_field&&!$(evt.target).hasClass("search-choice")&&!this.results_showing)return this.results_show()},Chosen.prototype.choice_build=function(item){var choice_id,html,link,_this=this;return this.is_multiple&&this.max_selected_options<=this.choices?(this.form_field_jq.trigger("liszt:maxselected",{chosen:this}),!1):(choice_id=this.container_id+"_c_"+item.array_index,this.choices+=1,item.disabled?html='<li class="search-choice search-choice-disabled" id="'+choice_id+'"><span>'+item.html+"</span></li>":html='<li class="search-choice" id="'+choice_id+'"><span>'+item.html+'</span><a href="javascript:void(0)" class="search-choice-close" rel="'+item.array_index+'"></a></li>',this.search_container.before(html),link=$("#"+choice_id).find("a").first(),link.click(function(evt){return _this.choice_destroy_link_click(evt)}))},Chosen.prototype.choice_destroy_link_click=function(evt){return evt.preventDefault(),this.is_disabled?evt.stopPropagation:(this.pending_destroy_click=!0,this.choice_destroy($(evt.target)))},Chosen.prototype.choice_destroy=function(link){if(this.result_deselect(link.attr("rel")))return this.choices-=1,this.show_search_field_default(),this.is_multiple&&this.choices>0&&this.search_field.val().length<1&&this.results_hide(),link.parents("li").first().remove()},Chosen.prototype.results_reset=function(){this.form_field.options[0].selected=!0,this.selected_item.find("span").text(this.default_text),this.is_multiple||this.selected_item.addClass("chzn-default"),this.show_search_field_default(),this.results_reset_cleanup(),this.form_field_jq.trigger("change");if(this.active_field)return this.results_hide()},Chosen.prototype.results_reset_cleanup=function(){return this.current_value=this.form_field_jq.val(),this.selected_item.find("abbr").remove()},Chosen.prototype.result_select=function(evt){var high,high_id,item,position;if(this.result_highlight)return high=this.result_highlight,high_id=high.attr("id"),this.result_clear_highlight(),this.is_multiple?this.result_deactivate(high):(this.search_results.find(".result-selected").removeClass("result-selected"),this.result_single_selected=high,this.selected_item.removeClass("chzn-default")),high.addClass("result-selected"),position=high_id.substr(high_id.lastIndexOf("_")+1),item=this.results_data[position],item.selected=!0,this.form_field.options[item.options_index].selected=!0,this.is_multiple?this.choice_build(item):(this.selected_item.find("span").first().text(item.text),this.allow_single_deselect&&this.single_deselect_control_build()),(!evt.metaKey||!this.is_multiple)&&this.results_hide(),this.search_field.val(""),(this.is_multiple||this.form_field_jq.val()!==this.current_value)&&this.form_field_jq.trigger("change",{selected:this.form_field.options[item.options_index].value}),this.current_value=this.form_field_jq.val(),this.search_field_scale()},Chosen.prototype.result_activate=function(el){return el.addClass("active-result")},Chosen.prototype.result_deactivate=function(el){return el.removeClass("active-result")},Chosen.prototype.result_deselect=function(pos){var result,result_data;return result_data=this.results_data[pos],this.form_field.options[result_data.options_index].disabled?!1:(result_data.selected=!1,this.form_field.options[result_data.options_index].selected=!1,result=$("#"+this.container_id+"_o_"+pos),result.removeClass("result-selected").addClass("active-result").show(),this.result_clear_highlight(),this.winnow_results(),this.form_field_jq.trigger("change",{deselected:this.form_field.options[result_data.options_index].value}),this.search_field_scale(),!0)},Chosen.prototype.single_deselect_control_build=function(){if(this.allow_single_deselect&&this.selected_item.find("abbr").length<1)return this.selected_item.find("span").first().after('<abbr class="search-choice-close"></abbr>')},Chosen.prototype.winnow_results=function(){var found,option,part,parts,regex,regexAnchor,result,result_id,results,searchText,startpos,text,zregex,_i,_j,_len,_len2,_ref;this.no_results_clear(),results=0,searchText=this.search_field.val()===this.default_text?"":$("<div/>").text($.trim(this.search_field.val())).html(),regexAnchor=this.search_contains?"":"^",regex=new RegExp(regexAnchor+searchText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&"),"i"),zregex=new RegExp(searchText.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&"),"i"),_ref=this.results_data;for(_i=0,_len=_ref.length;_i<_len;_i++){option=_ref[_i];if(!option.disabled&&!option.empty)if(option.group)$("#"+option.dom_id).css("display","none");else if(!this.is_multiple||!option.selected){found=!1,result_id=option.dom_id,result=$("#"+result_id);if(regex.test(option.html))found=!0,results+=1;else if(option.html.indexOf(" ")>=0||option.html.indexOf("[")===0){parts=option.html.replace(/\[|\]/g,"").split(" ");if(parts.length)for(_j=0,_len2=parts.length;_j<_len2;_j++)part=parts[_j],regex.test(part)&&(found=!0,results+=1)}found?(searchText.length?(startpos=option.html.search(zregex),text=option.html.substr(0,startpos+searchText.length)+"</em>"+option.html.substr(startpos+searchText.length),text=text.substr(0,startpos)+"<em>"+text.substr(startpos)):text=option.html,result.html(text),this.result_activate(result),option.group_array_index!=null&&$("#"+this.results_data[option.group_array_index].dom_id).css("display","list-item")):(this.result_highlight&&result_id===this.result_highlight.attr("id")&&this.result_clear_highlight(),this.result_deactivate(result))}}return results<1&&searchText.length?this.no_results(searchText):this.winnow_results_set_highlight()},Chosen.prototype.winnow_results_clear=function(){var li,lis,_i,_len,_results;this.search_field.val(""),lis=this.search_results.find("li"),_results=[];for(_i=0,_len=lis.length;_i<_len;_i++)li=lis[_i],li=$(li),li.hasClass("group-result")?_results.push(li.css("display","auto")):!this.is_multiple||!li.hasClass("result-selected")?_results.push(this.result_activate(li)):_results.push(void 0);return _results},Chosen.prototype.winnow_results_set_highlight=function(){var do_high,selected_results;if(!this.result_highlight){selected_results=this.is_multiple?[]:this.search_results.find(".result-selected.active-result"),do_high=selected_results.length?selected_results.first():this.search_results.find(".active-result").first();if(do_high!=null)return this.result_do_highlight(do_high)}},Chosen.prototype.no_results=function(terms){var no_results_html;return no_results_html=$('<li class="no-results">'+this.results_none_found+' "<span></span>"</li>'),no_results_html.find("span").first().html(terms),this.search_results.append(no_results_html)},Chosen.prototype.no_results_clear=function(){return this.search_results.find(".no-results").remove()},Chosen.prototype.keydown_arrow=function(){var first_active,next_sib;this.result_highlight?this.results_showing&&(next_sib=this.result_highlight.nextAll("li.active-result").first(),next_sib&&this.result_do_highlight(next_sib)):(first_active=this.search_results.find("li.active-result").first(),first_active&&this.result_do_highlight($(first_active)));if(!this.results_showing)return this.results_show()},Chosen.prototype.keyup_arrow=function(){var prev_sibs;if(!this.results_showing&&!this.is_multiple)return this.results_show();if(this.result_highlight)return prev_sibs=this.result_highlight.prevAll("li.active-result"),prev_sibs.length?this.result_do_highlight(prev_sibs.first()):(this.choices>0&&this.results_hide(),this.result_clear_highlight())},Chosen.prototype.keydown_backstroke=function(){var next_available_destroy;if(this.pending_backstroke)return this.choice_destroy(this.pending_backstroke.find("a").first()),this.clear_backstroke();next_available_destroy=this.search_container.siblings("li.search-choice").last();if(next_available_destroy.length&&!next_available_destroy.hasClass("search-choice-disabled"))return this.pending_backstroke=next_available_destroy,this.single_backstroke_delete?this.keydown_backstroke():this.pending_backstroke.addClass("search-choice-focus")},Chosen.prototype.clear_backstroke=function(){return this.pending_backstroke&&this.pending_backstroke.removeClass("search-choice-focus"),this.pending_backstroke=null},Chosen.prototype.keydown_checker=function(evt){var stroke,_ref;stroke=(_ref=evt.which)!=null?_ref:evt.keyCode,this.search_field_scale(),stroke!==8&&this.pending_backstroke&&this.clear_backstroke();switch(stroke){case 8:this.backstroke_length=this.search_field.val().length;break;case 9:this.results_showing&&!this.is_multiple&&this.result_select(evt),this.mouse_on_container=!1;break;case 13:evt.preventDefault();break;case 38:evt.preventDefault(),this.keyup_arrow();break;case 40:this.keydown_arrow()}},Chosen.prototype.search_field_scale=function(){var dd_top,div,h,style,style_block,styles,w,_i,_len;if(this.is_multiple){h=0,w=0,style_block="position:absolute; left: -1000px; top: -1000px; display:none;",styles=["font-size","font-style","font-weight","font-family","line-height","text-transform","letter-spacing"];for(_i=0,_len=styles.length;_i<_len;_i++)style=styles[_i],style_block+=style+":"+this.search_field.css(style)+";";return div=$("<div />",{style:style_block}),div.text(this.search_field.val()),$("body").append(div),w=div.width()+25,div.remove(),w>this.f_width-10&&(w=this.f_width-10),this.search_field.css({width:w+"px"}),dd_top=this.container.height(),this.dropdown.css({top:dd_top+"px"})}},Chosen.prototype.generate_random_id=function(){var string;string="sel"+this.generate_random_char()+this.generate_random_char()+this.generate_random_char();while($("#"+string).length>0)string+=this.generate_random_char();return string},Chosen}(AbstractChosen),get_side_border_padding=function(elmt){var side_border_padding;return side_border_padding=elmt.outerWidth()-elmt.width()},root.get_side_border_padding=get_side_border_padding}.call(this);																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																			 
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							/* uniform	 */																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																												(function(f,m){function h(a,b){for(var c in b)b.hasOwnProperty(c)&&(c.replace(/ |$/g,".uniform"),a.bind(c,b[c]))}function p(a){if(a[0].multiple)return!0;a=a.attr("size");return a===m||1>=a?!1:!0}function q(a,b,c){a=a.val();""===a?a=c.fileDefaultHtml:(a=a.split(/[\/\\]+/),a=a[a.length-1]);b.text(a)}function k(a,b){a.removeClass(b.hoverClass+" "+b.focusClass+" "+b.activeClass)}function i(a,b,c){var d=b.is(":checked");b.prop?b.prop("checked",d):d?b.attr("checked","checked"):b.removeAttr("checked");b=
c.checkedClass;d?a.addClass(b):a.removeClass(b)}function j(a,b,c){c=c.disabledClass;b.is(":disabled")?a.addClass(c):a.removeClass(c)}function n(a,b,c){switch(c){case "after":return a.after(b),a.next();case "before":return a.before(b),a.prev();case "wrap":return a.wrap(b),a.parent()}return null}function l(a,b,c){var d,e;c||(c={});c=f.extend({bind:{},css:null,divClass:null,divWrap:"wrap",spanClass:null,spanHtml:null,spanWrap:"wrap"},c);d=f("<div />");e=f("<span />");b.autoHide&&!a.is(":visible")&&d.hide();
c.divClass&&d.addClass(c.divClass);c.spanClass&&e.addClass(c.spanClass);b.useID&&a.attr("id")&&d.attr("id",b.idPrefix+"-"+a.attr("id"));c.spanHtml&&e.html(c.spanHtml);d=n(a,d,c.divWrap);e=n(a,e,c.spanWrap);c.css&&a.css(c.css);j(d,a,b);return{div:d,span:e}}f.uniform={defaults:{activeClass:"active",autoHide:!0,buttonClass:"button",checkboxClass:"checker",checkedClass:"checked",disabledClass:"disabled",fileButtonClass:"action",fileButtonHtml:"Choose File",fileClass:"uploader",fileDefaultHtml:"No file selected",
filenameClass:"filename",focusClass:"focus",hoverClass:"hover",idPrefix:"uniform",radioClass:"radio",resetDefaultHtml:"Reset",resetSelector:!1,selectAutoWidth:!1,selectClass:"selector",submitDefaultHtml:"Submit",useID:!0},elements:[]};var r=!0,s=[{match:function(a){return a.is("button, :submit, :reset, a, input[type='button']")},apply:function(a,b){var c,d;d=b.submitDefaultHtml;a.is(":reset")&&(d=b.resetDefaultHtml);if(a.is("a, button"))d=a.html()||d;else if(a.is(":submit, :reset, input[type=button]")){var e;
e=(e=a.attr("value"))?f("<span />").text(e).html():"";d=e||d}c=l(a,b,{css:{display:"none"},divClass:b.buttonClass,spanHtml:d}).div;h(c,{mouseenter:function(){c.addClass(b.hoverClass)},mouseleave:function(){c.removeClass(b.hoverClass);c.removeClass(b.activeClass)},"mousedown touchbegin":function(){c.addClass(b.activeClass)},"mouseup touchend":function(){c.removeClass(b.activeClass)},"click touchend":function(b){f(b.target).is("span, div")&&(a[0].dispatchEvent?(b=document.createEvent("MouseEvents"),
b.initEvent("click",!0,!0),a[0].dispatchEvent(b)):a.click())}});h(a,{focus:function(){c.addClass(b.focusClass)},blur:function(){c.removeClass(b.focusClass)}});f.uniform.noSelect(c);return{remove:function(){return a.unwrap().unwrap()},update:function(){k(c,b);j(c,a,b)}}}},{match:function(a){return a.is(":checkbox")},apply:function(a,b){var c,d,e;c=l(a,b,{css:{opacity:0},divClass:b.checkboxClass});d=c.div;e=c.span;h(a,{focus:function(){d.addClass(b.focusClass)},blur:function(){d.removeClass(b.focusClass)},
"click touchend":function(){i(e,a,b)},"mousedown touchbegin":function(){d.addClass(b.activeClass)},"mouseup touchend":function(){d.removeClass(b.activeClass)},mouseenter:function(){d.addClass(b.hoverClass)},mouseleave:function(){d.removeClass(b.hoverClass);d.removeClass(b.activeClass)}});i(e,a,b);return{remove:function(){return a.unwrap().unwrap()},update:function(){k(d,b);e.removeClass(b.checkedClass);i(e,a,b);j(d,b)}}}},{match:function(a){return a.is(":file")},apply:function(a,b){function c(){q(a,
g,b)}var d,e,g;d=l(a,b,{css:{opacity:0},divClass:b.fileClass,spanClass:b.fileButtonClass,spanHtml:b.fileButtonHtml,spanWrap:"after"});e=d.div;d=d.span;g=f("<span />").html(b.fileDefaultHtml);g.addClass(b.filenameClass);g=n(a,g,"after");a.attr("size")||a.attr("size",e.width()/10);c();h(a,{focus:function(){e.addClass(b.focusClass)},blur:function(){e.removeClass(b.focusClass)},mousedown:function(){a.is(":disabled")||e.addClass(b.activeClass)},mouseup:function(){e.removeClass(b.activeClass)},mouseenter:function(){e.addClass(b.hoverClass)},
mouseleave:function(){e.removeClass(b.hoverClass);e.removeClass(b.activeClass)}});f.browser.msie?h(a,{click:function(){a.trigger("change");setTimeout(c,0)}}):h(a,{change:c});f.uniform.noSelect(g);f.uniform.noSelect(d);return{remove:function(){a.siblings("span").remove();a.unwrap();return a},update:function(){k(e,b);q(a,g,b);j(e,a,b)}}}},{match:function(a){return a.is("input")?(a=a.attr("type").toLowerCase(),0<=" color date datetime datetime-local email month number password search tel text time url week ".indexOf(" "+
a+" ")):!1},apply:function(a){var b=a.attr("type");a.addClass(b);return{remove:function(){a.removeClass(b)},update:function(){}}}},{match:function(a){return a.is(":radio")},apply:function(a,b){var c,d,e;c=l(a,b,{css:{opacity:0},divClass:b.radioClass});d=c.div;e=c.span;h(a,{focus:function(){d.addClass(b.focusClass)},blur:function(){d.removeClass(b.focusClass)},"click touchend":function(){var c="."+b.radioClass.split(" ")[0]+" span."+b.checkedClass+":has([name='"+a.attr("name")+"'])";f(c).each(function(){var a=
f(this),c=a.find(":radio");i(a,c,b)});i(e,a,b)},"mousedown touchend":function(){a.is(":disabled")||d.addClass(b.activeClass)},"mouseup touchbegin":function(){d.removeClass(b.activeClass)},"mouseenter touchend":function(){d.addClass(b.hoverClass)},mouseleave:function(){d.removeClass(b.hoverClass);d.removeClass(b.activeClass)}});i(e,a,b);return{remove:function(){return a.unwrap().unwrap()},update:function(){k(d,b);i(e,a,b);j(d,a,b)}}}},{match:function(a){return a.is("select")&&!p(a)?!0:!1},apply:function(a,
b){var c,d,e,g;g=a.width();c=l(a,b,{css:{opacity:0,left:"2px",width:g+32+"px"},divClass:b.selectClass,spanHtml:(a.find(":selected:first")||a.find("option:first")).html(),spanWrap:"before"});d=c.div;e=c.span;b.selectAutoWidth?(d.width(f("<div />").width()-f("<span />").width()+g+25),c=parseInt(d.css("paddingLeft"),10),e.width(g-c-15),a.width(g+c),a.css("min-width",g+c+"px"),d.width(g+c)):(c=a.width(),d.width(c),e.width(c-25));h(a,{change:function(){e.html(a.find(":selected").html());d.removeClass(b.activeClass)},
focus:function(){d.addClass(b.focusClass)},blur:function(){d.removeClass(b.focusClass);d.removeClass(b.activeClass)},"mousedown touchbegin":function(){d.addClass(b.activeClass)},"mouseup touchend":function(){d.removeClass(b.activeClass)},"click touchend":function(){var b=a.find(":selected").html();e.html()!==b&&a.trigger("change")},mouseenter:function(){d.addClass(b.hoverClass)},mouseleave:function(){d.removeClass(b.hoverClass);d.removeClass(b.activeClass)},keyup:function(){e.html(a.find(":selected").html())}});
f.uniform.noSelect(e);return{remove:function(){a.siblings("span").remove();a.unwrap();return a},update:function(){k(d,b);e.html(a.find(":selected").html());j(d,a,b)}}}},{match:function(a){return a.is("select")&&p(a)?!0:!1},apply:function(a){a.addClass("uniform-multiselect");return{remove:function(){a.removeClass("uniform-multiselect")},update:function(){}}}},{match:function(a){return a.is("textarea")},apply:function(a){a.addClass("uniform");return{remove:function(){a.removeClass("uniform")},update:function(){}}}}];
f.browser.msie&&7>f.browser.version&&(r=!1);f.fn.uniform=function(a){var b=this,a=f.extend({},f.uniform.defaults,a);!1!==a.resetSelector&&f(a.resetSelector).mouseup(function(){window.setTimeout(function(){f.uniform.update(b)},10)});return this.each(function(){var b=f(this),d,e;b.data("uniformed")&&f.uniform.update(b);if(!b.data("uniformed")&&r)for(d=0;d<s.length;d+=1)if(e=s[d],e.match(b,a)){d=e.apply(b,a);b.data("uniformed",d);f.uniform.elements.push(b.get(0));break}})};f.uniform.restore=function(a){a===
m&&(a=f.uniform.elements);f(a).each(function(){var a=f(this),c;if(c=a.data("uniformed"))c.remove(),a.unbind(".uniform"),c=f.inArray(this,f.uniform.elements),0<=c&&f.uniform.elements.splice(c,1),a.removeData("uniformed")})};f.uniform.noSelect=function(a){var b=function(){return!1};f(a).each(function(){this.onselectstart=this.ondragstart=b;f(this).mousedown(b).css({MozUserSelect:"none"})})};f.uniform.update=function(a){a===m&&(a=f.uniform.elements);f(a).each(function(){var a=f(this),c;(c=a.data("uniformed"))&&
c.update(a,c.options)})}})(jQuery);
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							
																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																																							
/*!
 * jQuery / jqLite colorPicker ByGiro
 *
 * version 0.0.2
 * Copyright August 2016, G. Tomaselli
 * Licensed under the MIT license.
 *
 */

 
// compatibility for jQuery / jqLite
var bg = bg || false;
if(!bg){
	if(typeof jQuery != 'undefined'){
		bg = jQuery;
	} else if(typeof angular != 'undefined'){
		bg = angular.element;
		bg.extend = angular.extend;	
	
		
		bg.prototype.slideUp = $.prototype.hide = function(){
			var i,that = this;
			for(i=0;i<that.length;i++){
				that[i].style.display = 'none';
			}
			return that;
		}
		
		bg.prototype.slideDown = $.prototype.show = function(){
			var i,that = this;
			for(i=0;i<that.length;i++){
				that[i].style.display = '';
			}
			return that;
		}

		bg.prototype.find = function (selector){
			var context = this[0],matches = [];
			// Early return if context is not an element or document
			if (!context || (context.nodeType !== 1 && context.nodeType !== 9) || typeof selector != 'string') {
				return [];
			}
			
			for(var i=0;i<this.length;i++){
				var elm = this[i],
				nodes = bg(elm.querySelectorAll(selector));
				matches.push.apply(matches, nodes.slice());
			}
			
			return bg(matches);
		};
	}
}

;(function ($) {
    "use strict";

	var pluginName = 'colorPickerByGiro',
	timer = {},
	delay = function(callback, ms, type){
		clearTimeout (timer[type]);
		timer[type] = setTimeout(callback, ms);
	},
	
	fixValue = function(value, min, max){
		if(value < min) value = min;
		if(value > max) value = max;
		
		return value;
	},
	
	addColorPickerContainer = function(){
		var that = this,
		opts = that.settings,
		input = '<input type="text" value="" data-cp-t="',
		html='<div class="cpBG fade">'
				+ '<div class="cp-colors">'
					+ '<div class="cp-white">'
						+ '<div class="cp-black">'
							+ '<div class="cp-cursor"></div>'
						+ '</div>'
					+ '</div>'
					+ '<div class="cp-trigger"></div>'
				+ '</div>'
				
				+ '<div class="cp-hues">'
					+ '<div class="ie-1"></div>'
					+ '<div class="ie-2"></div>'
					+ '<div class="ie-3"></div>'
					+ '<div class="ie-4"></div>'
					+ '<div class="ie-5"></div>'
					+ '<div class="ie-6"></div>'
					+ '<div class="cp-cursor"></div>'
					+ '<div class="cp-trigger" data-cp-t="h"></div>'
				+ '</div>'
				
				+ '<div class="cp-alpha">'
					+ '<div class="cp-chess-bg"><div class="cp-chess"></div></div>'
					+ '<div class="cp-bg"></div>'
					+ '<div class="cp-cursor"></div>'
					+ '<div class="cp-trigger" data-cp-t="a"></div>'
				+ '</div>'
				
				+ '<div class="cp-values">'
					+ '<div class="cp-prev"><i>&nbsp;</i></div>'
					+ '<div class="cp-hex">Hex: '+ input +'" /></div>'
					+ '<div class="cp-r">R: '+ input +'r" /></div>'
					+ '<div class="cp-g">G: '+ input +'g" /></div>'
					+ '<div class="cp-b">B: '+ input +'b" /></div>'
					+ '<div class="cp-a">A: '+ input +'a" /></div>'
				+ '</div>'
				
				+ '<div class="cp-buttons">'
					+ '<div class="btn btn-default btn-none">'+ opts.text.none +'</div>'
					+ '<div class="btn btn-info btn-close">'+ opts.text.close +'</div>'
				+ '</div>'
				+ '<div class="clear"></div>'
            + '</div>';
			
		that.$main.append(html);
	},
	
	move = function(x, y){
		var that = this,
		opts = that.settings,
		dragType = that.dragType,
		dragRect = that.dragRect,
		hsva = that.hsva;

		x = Math.max(Math.min(x, dragRect.width), 0);
		y = Math.max(Math.min(y, dragRect.height), 0);

		if (dragType == 'h'){
			hsva.h = y / dragRect.height;
		} else if (dragType == 'a') {
			hsva.a = Number((y / dragRect.height).toFixed(3));
		} else {		
			hsva.s = x / dragRect.width;
			hsva.v = 1 - y / dragRect.height;
		}

		if (typeof hsva.s !== 'undefined'){
			that.setValue(hsva);
		}		
	},
	
	addEventsHandlers = function(){
		var that = this,
		opts = that.settings,
		dragging = false,
		
		dragStart = function(evt){
			if(dragging) return;
			evt.stopPropagation();
			evt.preventDefault();
			
			var trigger = $(evt.target).parent().find('.cp-trigger'),
			rect = trigger[0].getBoundingClientRect();

			that.dragType = trigger.attr('data-cp-t');
			dragging = true;
			

			that.dragRect = {
				x: rect.left,
				y: rect.top,
				width: rect.right - rect.left,
				height: rect.bottom - rect.top
			};

			move.call(that, evt.offsetX || evt.layerX, evt.offsetY || evt.layerY);
		},
		
		dragStop = function(evt){
			if(!dragging) return;
			evt.stopPropagation();
			
			dragging = false;			
			delete that.dragType;
			delete that.dragRect;			
		},
		rgbEle,
		cpBG = that.$main.find('.cpBG'),
		openPicker;

		that.$main.find('.cp-trigger')
			.on('mousedown touchstart',dragStart)
			.on('mouseup touchend',dragStop);
			
		that.$main.on('mousemove touchmove',function(e){
				if(!dragging) return;
				
				var dragRect = that.dragRect;
				move.call(that,e.clientX - dragRect.x, e.clientY - dragRect.y);			
			});
			
		$('body').on('mouseup touchend',dragStop);
		
		// add events handlers on inputs
		rgbEle = that.$main.find('.cp-values div:not(.cp-hex) [data-cp-t]');
		rgbEle.on('keyup',function(){
			delay(function(){
				var rgba = {};
				for(var i=0;i<rgbEle.length;i++){
					var ele = rgbEle[i],
					type = ele.getAttribute('data-cp-t'),
					val = parseFloat(ele.value);
					rgba[type] = (type != 'a') ? fixValue(val,0,255) : fixValue(val,0,1);
				}
				that.hsva = that.rgb2hsv(rgba.r,rgba.g,rgba.b);
				that.hsva.a = rgba.a;
				that.setValue();
			}, 350, 'r');
		});
		
		that.$main.find('.cp-hex input').on('keyup',function(){
			var $ele = $(this);
			delay(function(){
				that.setValue($ele.val());
			}, 350, 'h');
		});
		
		cpBG.slideUp();
		that.$main.find('.cp-buttons .btn-close').on('click',function(){
			cpBG.slideUp().removeClass('in');
		});
		
		that.$main.find('.cp-buttons .btn-none').on('click',function(){
			that.setValue({h:0, s:0, v:1, a:0});
			that.$eleInput.val('').triggerHandler('input');
			that.$main.find('input').val('');
		});
		
		openPicker = function(){
			cpBG.addClass('in').slideDown();
		}
		that.$eleInput.on('focus',openPicker);		
		that.$element.on('click',openPicker);
	},

    methods = {
        init: function ($element, options) {
            var that = this,
			val, hsva;
			 
            that.$element = $element;
            that.settings = $.extend({}, {
				
				preview: '', // a valid CSS selector / a DOM element / a jQuery-jqLite collection
				showPicker: true,

				format: 'hex',
				
				sliderGap: 6,
				cursorGap: 6,
				
				// internationalization
				text: {
					close: 'Close',
					none: 'None'
				}
            }, options)
			var rgb,opts = that.settings;
			
			opts.format = opts.format.toLowerCase();
			opts.preview = opts.preview.length ? opts.preview : false;
			
			// let's find the input
			that.$eleInput = that.$element.find('input');

			// wrap element into a container
			that.$main = that.$element.wrap('<div class="cp-cont"></div>').parent();
			
			// add colorPicker element
			addColorPickerContainer.call(that); 

			// add eventHandlers
			addEventsHandlers.call(that);
			
			 
			// default value
			/*that.hsva = {
				h: 1,
				s: 1,
				v: 1,
				a: 1
			}*/
			
			that.hsva = jQuery(that.$eleInput).val();
			
			// set initial status color picker
			that.setValue();
        },

		setValue: function(value){		 
			
			var that = this,
			opts = that.settings,
			value2Set = value || that.hsva,
			rgb,hex,bgcolor,inputVal = '',
			sliderGap = opts.sliderGap, cursorGap = opts.cursorGap,
			pickerCursor = that.$main.find('.cp-colors .cp-cursor'),
			hueCursor = that.$main.find('.cp-hues .cp-cursor'),
			alphaCursor = that.$main.find('.cp-alpha .cp-cursor'),
			previewColor;


 
			if(typeof value2Set == 'string'){
				value2Set = that.str2hsva(value2Set);
			}
		 
			that.hsva = value2Set;
			
			rgb = that.hsv2rgb(value2Set.h,value2Set.s,value2Set.v);
			rgb.a = (value2Set.a || value2Set.a === 0) ? value2Set.a : 1;
			bgcolor = that.hsv2rgb(value2Set.h,1,1);
			bgcolor = that.rgb2str(bgcolor.r,bgcolor.g,bgcolor.b);
			previewColor = that.rgb2str(rgb.r,rgb.g,rgb.b,value2Set.a);
			
			hex = that.rgb2hex(rgb.r,rgb.g,rgb.b);
			
			// set current Value in input
			switch(opts.format){					
				case 'hsl':
				case 'hsla':
					inputVal = that.hsv2hsl(value2Set.h,value2Set.s,value2Set.v);
					inputVal = that.hsl2str(inputVal.h,inputVal.s,inputVal.l,value2Set.a);
					break;
					
				case 'rgb':
				case 'rgba':
					inputVal = previewColor;
					break;

				case 'hex':
				default:
					inputVal = hex;
					break;
			}		
			
			
			 	
			// set current Value in input
			that.$eleInput.val(inputVal).triggerHandler('input');
			
			// and the preview
			if(opts.preview) (opts.preview instanceof $ ? opts.preview : that.$element.find(opts.preview)).css('background-color', previewColor);


			// set hexadecimal
			that.$main.find('.cp-values .cp-hex input').val(hex);
			
			// set RGB
			for(var k in rgb){				
				that.$main.find('.cp-values [data-cp-t="'+ k +'"]').val(rgb[k]);
			}
			
			// set hue cursor
			hueCursor.css('background-color',bgcolor);
			
			// set picker cursor background color
			pickerCursor.css('background-color',hex);
			
			// set background color picker
			that.$main.find('.cp-colors').css('background-color',bgcolor);
			
			// set background alpha cursor
			that.$main.find('.cp-alpha .cp-cursor').css('background',previewColor);
			
			// set background alpha
			that.$main.find('.cp-alpha .cp-bg').css('background','linear-gradient(to bottom, transparent, '+ hex +')');
		
			// change color cursor position
			pickerCursor.css({ left: (value2Set.s * 200) - cursorGap + 'px', top: ((1 - value2Set.v) * 200) - cursorGap + 'px' });

			// change hue cursor position
			hueCursor.css('top',(value2Set.h * 200) - sliderGap + 'px');
			
			// change alpha cursor position
			alphaCursor.css('top',(value2Set.a * 200) - sliderGap + 'px');				
			
			// set preview final color
			that.$main.find('.cp-values .cp-prev i').css('background-color',previewColor);
			
			delay(function(){
				that.$element.triggerHandler('selected.colorPickerByGiro', {
					hexadecimal: hex,
					hsva: that.hsva,
					rgba: rgb,
					rgbaStr: previewColor
				});
			},
			400,'c');
			
			if(jQuery(that.$eleInput).val() == "#FFFFFF"){ 
			jQuery(that.$eleInput).val('');
			}
		},
		
		// utilities
		str2hsva: function(colorStr){
			var that=this,str,rgb = {}, hsva = undefined, val;
			function getComponents(substr){
				return substr.replace(/[a-z;\(\)]/g,'').split(',');				
			}
			
			if(!colorStr || colorStr == '') colorStr = '#fff';
			// clean string
			str = colorStr.trim().toLowerCase();			
			
			if(str.indexOf('rgb') >= 0){
				// we have rgb
				str = getComponents(str);
				 
				for(var i=0;i<3;i++){
					val = parseFloat(str[i]);
					if(str[i].indexOf('%') >= 0){						
						// we have a percentage value
						val *= 2.55;
					}
					str[i] = val;
				}
				hsva = that.rgb2hsv(str[0],str[1],str[2]);
				if(str.length == 4)hsva.a = str[3];
			} else if(str.indexOf('hsl') >= 0){
				// we have hsl
				str = getComponents(str);
				hsva = that.hsl2hsv(str[0]/360, str[1]/100, str[2]/100);
				if(str.length == 4)hsva.a = str[3];
			} else { // assume it's hexadecimal with or without '#'
				// we have hex
				rgb = that.hex2rgb(str);
				hsva = that.rgb2hsv(rgb.r,rgb.g,rgb.b);
			}
			
			return hsva;
		},
	
		hsv2rgb: function(h, s, v) {
			var Mathfloor = Math.floor,
				parseFl = parseFloat;
				
			h = parseFl(h) || 0;
			s = parseFl(s) || 0;
			v = parseFl(v) || 0;
			
			var x=255,
				i = Mathfloor(h * 6),
				f = h * 6 - i,
				p = v * (1 - s),
				q = v * (1 - f * s),
				t = v * (1 - (1 - f) * s),
				r, g, b;

			switch (i % 6) {
			case 0:
				r = v;
				g = t;
				b = p;
				break;
			case 1:
				r = q;
				g = v;
				b = p;
				break;
			case 2:
				r = p;
				g = v;
				b = t;
				break;
			case 3:
				r = p;
				g = q;
				b = v;
				break;
			case 4:
				r = t;
				g = p;
				b = v;
				break;
			case 5:
				r = v;
				g = p;
				b = q;
				break;
			}

			return {
				r:Mathfloor(r * x),
				g:Mathfloor(g * x),
				b:Mathfloor(b * x)
			};
		},
		
		rgb2hsv: function(r, g, b) { // 0 >= r, g, b <=255
			var max = Math.max(r, g, b), min = Math.min(r, g, b),
				d = max - min,
				h,
				s = (max === 0 ? 0 : d / max),
				v = max / 255;

			switch (max) {
				case min: h = 0; break;
				case r: h = (g - b) + d * (g < b ? 6: 0); h /= 6 * d; break;
				case g: h = (b - r) + d * 2; h /= 6 * d; break;
				case b: h = (r - g) + d * 4; h /= 6 * d; break;
			}

			return {
				h: h,
				s: s,
				v: v
			};
		},
	
		hex2rgb: function(hex) {
			var h=hex.replace('#', '').slice(0,6);
			 
			h =  h.match(new RegExp('(.{'+h.length/3+'})', 'g'));

			for(var i=0; i<h.length; i++)
				h[i] = parseInt(h[i].length==1? h[i]+h[i]:h[i], 16);

			return {
				r: h[0],
				g: h[1],
				b: h[2]
			};
		},
		
		rgb2str: function(red, green, blue, alpha){
			var type = 'rgb',h = [red,green,blue];
			if (typeof alpha != 'undefined'){
				type += 'a';
				h.push(alpha);
			}

			return type + '('+h.join(',')+')';			
		},

		rgb2hex: function (red, green, blue) {
			return "#" + ((1 << 24) + (red << 16) + (green << 8) + blue).toString(16).slice(1).toUpperCase();
		},
		
		// source for the following 2 functions: https://gist.github.com/xpansive/1337890
		// if you wanna use percentages for saturation and value, divide / 100, if HUE is a number between 0-360 divide / 360
		hsv2hsl: function(hue,sat,val){
			return{
					//Range should be between 0 - 1
				h: hue, //Hue stays the same

				//Saturation is very different between the two color spaces
				//If (2-sat)*val < 1 set it to sat*val/((2-sat)*val)
				//Otherwise sat*val/(2-(2-sat)*val)
				//Conditional is not operating with hue, it is reassigned!
				s: sat*val/((hue=(2-sat)*val)<1?hue:2-hue), 
				
				l: hue/2 //Lightness is (2-sat)*val/2
				//See reassignment of hue above
			}
		},

		// if you wanna use percentages for saturation and value, divide / 100, if HUE is a number between 0-360 divide / 360
		hsl2hsv: function(hue,sat,light){
			sat*=light<.5?light:1-light;

			return{
			//Range should be between 0 - 1
				
				h: hue, //Hue stays the same
				s: 2*sat/(light+sat), //Saturation
				v: light+sat //Value
			}
		},
		
		hsl2str: function(hue, sat, light, alpha){
			var type = 'hsl',h = [hue*360,(sat*100)+'%',(light*100)+'%'];
			if (typeof alpha != 'undefined'){
				type += 'a';
				h.push(alpha);
			}

			return type + '('+h.join(',')+')';			
		}
    },
	
	main = function (method) {
        var pluginInstance = this.data(pluginName +'_data');
        if (pluginInstance) {
            if (typeof method === 'string' && pluginInstance[method]) {
                return pluginInstance[method].apply(pluginInstance, Array.prototype.slice.call(arguments, 1));
            }
            return console.log('Method ' +  method + ' does not exist on jQuery.'+ pluginName);
        } else {
            if (!method || typeof method === 'object') {
				
				var listCount = this.length;
				for ( var i = 0; i < listCount; i ++) {
					var $this = $(this[i]);
                    pluginInstance = $.extend({}, methods);
                    pluginInstance.init($this, method);
                    $this.data(pluginName +'_data', pluginInstance);
				};

				return this;
            }
            return console.log('jQuery.'+ pluginName +' is not instantiated. Please call $("selector").'+ pluginName +'({options})');
        }
    };

	// plugin integration
	if($.fn){
		$.fn[pluginName] = main;
	} else {
		$.prototype[pluginName] = main;
	}
}(bg));
