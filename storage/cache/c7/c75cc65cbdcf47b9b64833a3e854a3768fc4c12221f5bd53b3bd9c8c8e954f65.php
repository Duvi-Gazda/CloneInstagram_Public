<?php

/* extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute.twig */
class __TwigTemplate_447fe667235c77f9d565fe80dba7d686d6aee34b1f0aee5943f16ea0d5ef74b7 extends Twig_Template
{
    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo (isset($context["header"]) ? $context["header"] : null);
        echo "
<div id=\"content\">
\t<div class=\"page-header\">
\t\t<div class=\"container-fluid\">
\t\t\t<div class=\"pull-right\">
\t\t\t\t<button type=\"submit\" form=\"form-module\" data-toggle=\"tooltip\" name=\"action\" value=\"connected_itdaat_attribute|";
        // line 6
        echo (isset($context["itdaat_attribute_id"]) ? $context["itdaat_attribute_id"] : null);
        echo "\"  title=\"";
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\">
\t\t\t\t\t<i class=\"fa fa-save\"></i>
\t\t\t\t</button>
\t\t\t\t<a href=\"";
        // line 9
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\">
\t\t\t\t\t<i class=\"fa fa-reply\"></i>
\t\t\t\t</a>
                <a href=\"";
        // line 12
        echo (isset($context["back_url"]) ? $context["back_url"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\">
\t\t\t\t\t<i class=\"fa fa-home\"></i>
\t\t\t\t</a>
\t\t\t</div>
\t\t\t<h1>";
        // line 16
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">";
        // line 18
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 19
            echo "\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 20
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a>
\t\t\t\t\t</li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 23
        echo "\t\t\t</ul>
\t\t</div>
\t</div>
\t<div class=\"container-fluid\">";
        // line 27
        if ($this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array())) {
            // line 28
            echo "\t\t\t<div class=\"alert alert-danger alert-dismissible\">
\t\t\t\t<i class=\"fa fa-exclamation-circle\"></i>";
            // line 30
            echo $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array());
            echo "
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>";
        }
        // line 34
        echo "\t\t<div class=\"panel panel-default\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">
\t\t\t\t\t<i class=\"fa fa-pencil\"></i>";
        // line 38
        echo (isset($context["text_edit"]) ? $context["text_edit"] : null);
        echo "</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<form action=\"";
        // line 41
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">";
        // line 42
        echo (isset($context["itdaatInputs"]) ? $context["itdaatInputs"] : null);
        echo "
\t\t\t\t</div>
\t\t\t</div>
\t\t\t<div class=\"panel panel-default\" id=\"panel-more-space\">
\t\t\t\t<div
\t\t\t\t\tclass=\"panel-body\">
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<div class=\"col-sm-6\">
\t\t\t\t\t\t\t<div class=\"col-sm-12 text-center\">
\t\t\t\t\t\t\t\t<h3>Attributes</h3>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div
\t\t\t\t\t\t\t\tclass=\"col-sm-12\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t\t\t\t\t<h3>";
        // line 57
        echo (isset($context["itdaat_oc_attribute_name"]) ? $context["itdaat_oc_attribute_name"] : null);
        echo "</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-sm-10 overflow-auto itdaat-container itdaat-container-overflow\">";
        // line 60
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_oc_attribute_values"]) ? $context["itdaat_oc_attribute_values"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_oc_attribute_value"]) {
            // line 61
            echo "\t\t\t\t\t\t\t\t\t\t<div class=\"list-group col-sm-12\">
\t\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\"  name=\"";
            // line 62
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" value=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" id=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" onClick=\"addSelect(this.id)\"/>
\t\t\t\t\t\t\t\t\t\t\t<label class=\"list-group-item\" for=\"";
            // line 63
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\">";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "</label>
\t\t\t\t\t\t\t\t\t\t</div>
                                        <div class=\"col-sm-3 hidden text-center\" id=\"";
            // line 65
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "_select\">
                                            <select id=\"";
            // line 66
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "id", array());
            echo "\" name=\"attribute_action[";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "id", array());
            echo "]\" class=\"form-control\" style=\"width:100%;\">
                                                <option value=\"no\" id=\"no\">";
            // line 67
            echo (isset($context["no"]) ? $context["no"] : null);
            echo "</option>
                                                <option value=\"new\" id=\"new\">";
            // line 68
            echo (isset($context["new"]) ? $context["new"] : null);
            echo "</option>";
            // line 69
            $context['_parent'] = $context;
            $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_attribute_values"]) ? $context["itdaat_attribute_values"] : null));
            foreach ($context['_seq'] as $context["_key"] => $context["itdaat_attribute_value"]) {
                // line 70
                echo "                                                    <option value=\"";
                echo $this->getAttribute($context["itdaat_attribute_value"], "id", array());
                echo "\" id=\"select_";
                echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
                echo "\">";
                echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
                echo "</option>";
            }
            $_parent = $context['_parent'];
            unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_attribute_value'], $context['_parent'], $context['loop']);
            $context = array_intersect_key($context, $_parent) + $_parent;
            // line 72
            echo "                                            </select>
                                        </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_oc_attribute_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-sm-6\" style=\"border-left: 1px solid black;\">
\t\t\t\t\t\t\t<div class=\"col-sm-12 text-center\">
\t\t\t\t\t\t\t\t<h3>";
        // line 81
        echo (isset($context["itdaat_attribute_name"]) ? $context["itdaat_attribute_name"] : null);
        echo "</h3>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-12 itdaat-container-overflow\">";
        // line 85
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_attribute_values"]) ? $context["itdaat_attribute_values"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_attribute_value"]) {
            // line 86
            echo "                                    <div class=\"list-group col-sm-10\">
\t\t\t\t\t\t\t\t\t\t\t<input disabled type=\"checkbox\" name=\"";
            // line 87
            echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
            echo "\" value=\"";
            echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
            echo "\" id=\"itdaat_";
            echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
            echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t<label class=\"list-group-item\" for=\"itdaat_";
            // line 88
            echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
            echo "\">&nbsp;";
            echo $this->getAttribute($context["itdaat_attribute_value"], "value", array());
            echo "</label>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t<div class=\"container col-sm-2\">
\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-danger\" type=\"submit\" name=\"action\" value=\"delete_itdaat_attribute|";
            // line 91
            echo (isset($context["itdaat_attribute_id"]) ? $context["itdaat_attribute_id"] : null);
            echo "|";
            echo $this->getAttribute($context["itdaat_attribute_value"], "id", array());
            echo "\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-trash\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-primary\" type=\"submit\" name=\"action\" value=\"change_itdaat_attribute|";
            // line 94
            echo (isset($context["itdaat_attribute_id"]) ? $context["itdaat_attribute_id"] : null);
            echo "|";
            echo $this->getAttribute($context["itdaat_attribute_value"], "id", array());
            echo "\">
\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-pencil\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_attribute_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 99
        echo "\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>
\t\t\t\t\t</div>
\t\t\t\t</form>
\t\t\t</div>
\t\t</div>
\t</div>
</div>
";
    }

    public function getTemplateName()
    {
        return "extension/module/itdaat_attributer/itdaat_attributer_connect_itdaat_attribute.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  245 => 99,  233 => 94,  225 => 91,  217 => 88,  209 => 87,  206 => 86,  202 => 85,  196 => 81,  188 => 75,  181 => 72,  169 => 70,  165 => 69,  162 => 68,  158 => 67,  152 => 66,  148 => 65,  141 => 63,  133 => 62,  130 => 61,  126 => 60,  121 => 57,  103 => 42,  100 => 41,  94 => 38,  89 => 34,  83 => 30,  80 => 28,  78 => 27,  73 => 23,  63 => 20,  60 => 19,  56 => 18,  52 => 16,  43 => 12,  35 => 9,  27 => 6,  19 => 1,);
    }
}
/* {{header}}*/
/* <div id="content">*/
/* 	<div class="page-header">*/
/* 		<div class="container-fluid">*/
/* 			<div class="pull-right">*/
/* 				<button type="submit" form="form-module" data-toggle="tooltip" name="action" value="connected_itdaat_attribute|{{itdaat_attribute_id}}"  title="{{ button_save }}" class="btn btn-primary">*/
/* 					<i class="fa fa-save"></i>*/
/* 				</button>*/
/* 				<a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default">*/
/* 					<i class="fa fa-reply"></i>*/
/* 				</a>*/
/*                 <a href="{{ back_url }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default">*/
/* 					<i class="fa fa-home"></i>*/
/* 				</a>*/
/* 			</div>*/
/* 			<h1>{{ heading_title }}</h1>*/
/* 			<ul class="breadcrumb">*/
/* 				{% for breadcrumb in breadcrumbs %}*/
/* 					<li>*/
/* 						<a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a>*/
/* 					</li>*/
/* 				{% endfor %}*/
/* 			</ul>*/
/* 		</div>*/
/* 	</div>*/
/* 	<div class="container-fluid">*/
/* 		{% if error.error_warning %}*/
/* 			<div class="alert alert-danger alert-dismissible">*/
/* 				<i class="fa fa-exclamation-circle"></i>*/
/* 				{{ error.error_warning }}*/
/* 				<button type="button" class="close" data-dismiss="alert">&times;</button>*/
/* 			</div>*/
/* 		{% endif %}*/
/* 		<div class="panel panel-default">*/
/* 			<div class="panel-heading">*/
/* 				<h3 class="panel-title">*/
/* 					<i class="fa fa-pencil"></i>*/
/* 					{{ text_edit }}</h3>*/
/* 			</div>*/
/* 			<div class="panel-body">*/
/* 				<form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">*/
/* 					{{itdaatInputs}}*/
/* 				</div>*/
/* 			</div>*/
/* 			<div class="panel panel-default" id="panel-more-space">*/
/* 				<div*/
/* 					class="panel-body">*/
/* 					<div class="col-sm-12">*/
/* 						<div class="col-sm-6">*/
/* 							<div class="col-sm-12 text-center">*/
/* 								<h3>Attributes</h3>*/
/* 								<br>*/
/* 							</div>*/
/* 							<div*/
/* 								class="col-sm-12">*/
/* 								<div class="col-sm-2">*/
/* 									<h3>{{itdaat_oc_attribute_name}}</h3>*/
/* 								</div>*/
/* 								<div class="col-sm-10 overflow-auto itdaat-container itdaat-container-overflow">*/
/* 									{% for itdaat_oc_attribute_value in itdaat_oc_attribute_values %}*/
/* 										<div class="list-group col-sm-12">*/
/* 											<input type="checkbox"  name="{{itdaat_oc_attribute_value.value}}" value="{{itdaat_oc_attribute_value.value}}" id="{{itdaat_oc_attribute_value.value}}" onClick="addSelect(this.id)"/>*/
/* 											<label class="list-group-item" for="{{itdaat_oc_attribute_value.value}}">{{itdaat_oc_attribute_value.value}}</label>*/
/* 										</div>*/
/*                                         <div class="col-sm-3 hidden text-center" id="{{itdaat_oc_attribute_value.value}}_select">*/
/*                                             <select id="{{itdaat_oc_attribute_value.id}}" name="attribute_action[{{itdaat_oc_attribute_value.id}}]" class="form-control" style="width:100%;">*/
/*                                                 <option value="no" id="no">{{no}}</option>*/
/*                                                 <option value="new" id="new">{{new}}</option>*/
/*                                                 {% for itdaat_attribute_value in itdaat_attribute_values %}*/
/*                                                     <option value="{{itdaat_attribute_value.id}}" id="select_{{itdaat_attribute_value.value}}">{{itdaat_attribute_value.value}}</option>*/
/*                                                 {% endfor %}*/
/*                                             </select>*/
/*                                         </div>*/
/* 									{% endfor %}*/
/* 								</div>*/
/* 							</div>*/
/* 						</div>*/
/* */
/* 						<div class="col-sm-6" style="border-left: 1px solid black;">*/
/* 							<div class="col-sm-12 text-center">*/
/* 								<h3>{{itdaat_attribute_name}}</h3>*/
/* 								<br>*/
/* 							</div>*/
/* 							<div class="col-sm-12 itdaat-container-overflow">*/
/*                                 {% for itdaat_attribute_value in itdaat_attribute_values %}*/
/*                                     <div class="list-group col-sm-10">*/
/* 											<input disabled type="checkbox" name="{{itdaat_attribute_value.value}}" value="{{itdaat_attribute_value.value}}" id="itdaat_{{itdaat_attribute_value.value}}"/>*/
/* 											<label class="list-group-item" for="itdaat_{{itdaat_attribute_value.value}}">&nbsp;{{itdaat_attribute_value.value}}</label>*/
/* 									</div>*/
/* 									<div class="container col-sm-2">*/
/* 										<button class="btn btn-danger" type="submit" name="action" value="delete_itdaat_attribute|{{itdaat_attribute_id}}|{{itdaat_attribute_value.id}}">*/
/* 											<i class="fa fa-trash" aria-hidden="true"></i>*/
/* 										</button>*/
/* 										<button class="btn btn-primary" type="submit" name="action" value="change_itdaat_attribute|{{itdaat_attribute_id}}|{{itdaat_attribute_value.id}}">*/
/* 											<i class="fa fa-pencil" aria-hidden="true"></i>*/
/* 										</button>*/
/* 									</div>*/
/*                                 {% endfor %}*/
/* 							</div>*/
/* 						</div>*/
/* 					</div>*/
/* 				</form>*/
/* 			</div>*/
/* 		</div>*/
/* 	</div>*/
/* </div>*/
/* */
