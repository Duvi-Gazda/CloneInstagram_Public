<?php

/* extension/module/itdaat_attributer/itdaat_attributer_add_itdaat_attribute.twig */
class __TwigTemplate_009530cc779547703bae10f56bf7837c4ad1222b82177b3361a13decf0210085 extends Twig_Template
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
\t\t\t\t<button type=\"submit\" form=\"form-module\" name=\"action\" value=\"new_itdaat_attribute\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\">
\t\t\t\t\t<i class=\"fa fa-plus\" aria-hidden=\"true\"></i>
\t\t\t\t</button>
\t\t\t\t<a href=\"";
        // line 9
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\">
\t\t\t\t\t<i class=\"fa fa-reply\"></i>
\t\t\t\t</a>
\t\t\t\t<a href=\"";
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
\t\t\t\t<div class=\"panel-body\">
\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t<div class=\"col-sm-12 text-center\">
\t\t\t\t\t\t\t<h3>Create new attribute</h3>
\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t</div>";
        // line 55
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_languages"]) ? $context["itdaat_languages"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["language"]) {
            // line 56
            echo "\t\t\t\t\t\t\t<div class=\"col-sm-12 text-center\" style=\"margin-bottom:30px\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-2\">
\t\t\t\t\t\t\t\t\t<label class=\"list-group-item\" for=\"";
            // line 58
            echo $this->getAttribute($context["language"], "name", array());
            echo "\">";
            echo $this->getAttribute($context["language"], "name", array());
            echo "</label>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"input-group col-sm-10\">
\t\t\t\t\t\t\t\t\t<input required type=\"text\" class=\"form-control\" placeholder=\"";
            // line 61
            echo (isset($context["add_attribute_placeholder"]) ? $context["add_attribute_placeholder"] : null);
            echo "&nbsp;";
            echo $this->getAttribute($context["language"], "name", array());
            echo "\" id=\"txtSearch\" name=\"itdaat_attributes_name[";
            echo $this->getAttribute($context["language"], "language_id", array());
            echo "]\"/>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['language'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 67
        echo "\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t<div class=\"col-sm-12 overflow-auto itdaat-container itdaat-container-overflow\">";
        // line 69
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_oc_attribute_values"]) ? $context["itdaat_oc_attribute_values"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_oc_attribute_value"]) {
            // line 70
            echo "\t\t\t\t\t\t\t\t\t<div class=\"list-group\">
\t\t\t\t\t\t\t\t\t\t<input type=\"checkbox\" name=\"itdaat_oc_attributes[";
            // line 71
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "id", array());
            echo "]\" value=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" id=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\"/>
\t\t\t\t\t\t\t\t\t\t<label class=\"list-group-item\" for=\"";
            // line 72
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\">&nbsp;";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "</label>
\t\t\t\t\t\t\t\t\t</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_oc_attribute_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 75
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
        return "extension/module/itdaat_attributer/itdaat_attributer_add_itdaat_attribute.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  170 => 75,  160 => 72,  152 => 71,  149 => 70,  145 => 69,  142 => 67,  129 => 61,  121 => 58,  117 => 56,  113 => 55,  101 => 42,  98 => 41,  92 => 38,  87 => 34,  81 => 30,  78 => 28,  76 => 27,  71 => 23,  61 => 20,  58 => 19,  54 => 18,  50 => 16,  41 => 12,  33 => 9,  27 => 6,  19 => 1,);
    }
}
/* {{header}}*/
/* <div id="content">*/
/* 	<div class="page-header">*/
/* 		<div class="container-fluid">*/
/* 			<div class="pull-right">*/
/* 				<button type="submit" form="form-module" name="action" value="new_itdaat_attribute" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary">*/
/* 					<i class="fa fa-plus" aria-hidden="true"></i>*/
/* 				</button>*/
/* 				<a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default">*/
/* 					<i class="fa fa-reply"></i>*/
/* 				</a>*/
/* 				<a href="{{ back_url }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default">*/
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
/* 				<div class="panel-body">*/
/* 					<div class="col-sm-12">*/
/* 						<div class="col-sm-12 text-center">*/
/* 							<h3>Create new attribute</h3>*/
/* 							<br>*/
/* 						</div>*/
/* */
/* 						{# <div class="col-sm-6"> #}*/
/* */
/* 						{% for language in itdaat_languages %}*/
/* 							<div class="col-sm-12 text-center" style="margin-bottom:30px">*/
/* 								<div class="col-sm-2">*/
/* 									<label class="list-group-item" for="{{language.name}}">{{language.name}}</label>*/
/* 								</div>*/
/* 								<div class="input-group col-sm-10">*/
/* 									<input required type="text" class="form-control" placeholder="{{add_attribute_placeholder}}&nbsp; {{language.name}}" id="txtSearch" name="itdaat_attributes_name[{{language.language_id}}]"/>*/
/* 								</div>*/
/* 							</div>*/
/* 						{% endfor %}*/
/* */
/* 						{# </div> #}*/
/* 						<div class="col-sm-12">*/
/* 							<div class="col-sm-12 overflow-auto itdaat-container itdaat-container-overflow">*/
/* 								{% for itdaat_oc_attribute_value in itdaat_oc_attribute_values %}*/
/* 									<div class="list-group">*/
/* 										<input type="checkbox" name="itdaat_oc_attributes[{{itdaat_oc_attribute_value.id}}]" value="{{itdaat_oc_attribute_value.value}}" id="{{itdaat_oc_attribute_value.value}}"/>*/
/* 										<label class="list-group-item" for="{{itdaat_oc_attribute_value.value}}">&nbsp;{{itdaat_oc_attribute_value.value}}</label>*/
/* 									</div>*/
/* 								{% endfor %}*/
/* 							</div>*/
/* 						</div>*/
/* 					</div>*/
/* 				</form>*/
/* 			</div>*/
/* 		</div>*/
/* 	</div>*/
/* </div>*/
/* */
