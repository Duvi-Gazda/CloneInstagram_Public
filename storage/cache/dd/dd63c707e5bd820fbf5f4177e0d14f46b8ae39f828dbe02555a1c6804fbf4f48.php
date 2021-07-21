<?php

/* extension/module/itdaat_attributer.twig */
class __TwigTemplate_2fa366d4e2105ccbe3ed36428ee36235697531b8b69aa7d5c36db59548cbc8ed extends Twig_Template
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
\t\t\t\t<button type=\"submit\" form=\"form-module\" data-toggle=\"tooltip\" title=\"";
        // line 6
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
\t\t\t</div>
\t\t\t<h1>";
        // line 13
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
\t\t\t<ul class=\"breadcrumb\">";
        // line 15
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 16
            echo "\t\t\t\t\t<li>
\t\t\t\t\t\t<a href=\"";
            // line 17
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a>
\t\t\t\t\t</li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 20
        echo "\t\t\t</ul>
\t\t</div>
\t</div>
\t<div class=\"container-fluid\">";
        // line 24
        if ($this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array())) {
            // line 25
            echo "\t\t\t<div class=\"alert alert-danger alert-dismissible\">
\t\t\t\t<i class=\"fa fa-exclamation-circle\"></i>";
            // line 27
            echo $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array());
            echo "
\t\t\t\t<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
\t\t\t</div>";
        }
        // line 31
        echo "\t\t<div class=\"panel panel-default\">
\t\t\t<div class=\"panel-heading\">
\t\t\t\t<h3 class=\"panel-title\">
\t\t\t\t\t<i class=\"fa fa-pencil\"></i>";
        // line 35
        echo (isset($context["text_edit"]) ? $context["text_edit"] : null);
        echo "</h3>
\t\t\t</div>
\t\t\t<div class=\"panel-body\">
\t\t\t\t<form action=\"";
        // line 38
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">";
        // line 39
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
        // line 54
        echo (isset($context["itdaat_oc_attribute_name"]) ? $context["itdaat_oc_attribute_name"] : null);
        echo "</h3>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-sm-10 overflow-auto itdaat-container itdaat-container-overflow\">";
        // line 57
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_oc_attribute_values"]) ? $context["itdaat_oc_attribute_values"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_oc_attribute_value"]) {
            // line 58
            echo "\t\t\t\t\t\t\t\t\t\t<div class=\"list-group\">
\t\t\t\t\t\t\t\t\t\t\t<input disabled type=\"checkbox\" name=\"";
            // line 59
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" value=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" id=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\"/>
\t\t\t\t\t\t\t\t\t\t\t<label class=\"list-group-item\" for=\"";
            // line 60
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\">&nbsp;";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "</label>
\t\t\t\t\t\t\t\t\t\t</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_oc_attribute_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 63
        echo "\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t</div>

\t\t\t\t\t\t<div class=\"col-sm-6\" style=\"border-left: 1px solid black;\">
\t\t\t\t\t\t\t<div class=\"col-sm-12 text-center\">
\t\t\t\t\t\t\t\t<h3>New Attributes</h3>
\t\t\t\t\t\t\t\t<br>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div class=\"col-sm-12\" style=\"margin-bottom:30px\">
\t\t\t\t\t\t\t\t<div class=\"col-sm-11\">
\t\t\t\t\t\t\t\t\t<div class=\"input-group\">
\t\t\t\t\t\t\t\t\t\t<input type=\"text\" class=\"form-control\" placeholder=\"Search\" id=\"txtSearch\"/>
\t\t\t\t\t\t\t\t\t\t<div class=\"input-group-btn\">
\t\t\t\t\t\t\t\t\t\t\t<button class=\"btn btn-primary\" type=\"submit\" name=\"search\" value=\"search\">
\t\t\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-search\"></i>
\t\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t<div class=\"col-sm-1\">
\t\t\t\t\t\t\t\t\t<button class=\"btn btn-primary\" type=\"submit\" name=\"action\" value=\"new_itdaat_attribute\">
\t\t\t\t\t\t\t\t\t\t<i class=\"fa fa-plus\" aria-hidden=\"true\"></i>
\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t<div
\t\t\t\t\t\t\t\tclass=\"col-sm-12 itdaat-container-overflow\">";
        // line 91
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_attributes"]) ? $context["itdaat_attributes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_attribute"]) {
            // line 92
            echo "\t\t\t\t\t\t\t\t\t<div class=\"col-sm-12\">
\t\t\t\t\t\t\t\t\t\t<button  type=\"submit\" name=\"action\" value=\"connect_itdaat_attribute|";
            // line 93
            echo $this->getAttribute($context["itdaat_attribute"], "id", array());
            echo "\" style=\"all: unset; width: 100%;\"  class=\"btn btn-primary btn-lg btn-block\">
\t\t\t\t\t\t\t\t\t\t\t<div class=\"list-group\">
\t\t\t\t\t\t\t\t\t\t\t\t<a class=\"list-group-item \">
\t\t\t\t\t\t\t\t\t\t\t\t\t<h4 class=\"list-group-item-heading\">";
            // line 96
            echo $this->getAttribute($context["itdaat_attribute"], "name", array());
            echo "</h4>
\t\t\t\t\t\t\t\t\t\t\t\t\t<p class=\"list-group-item-text\">";
            // line 97
            echo $this->getAttribute($context["itdaat_attribute"], "value", array());
            echo "</p>
\t\t\t\t\t\t\t\t\t\t\t\t</a>
\t\t\t\t\t\t\t\t\t\t\t</div>
\t\t\t\t\t\t\t\t\t\t</button>
\t\t\t\t\t\t\t\t\t</div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_attribute'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 103
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
        return "extension/module/itdaat_attributer.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  198 => 103,  187 => 97,  183 => 96,  177 => 93,  174 => 92,  170 => 91,  141 => 63,  131 => 60,  123 => 59,  120 => 58,  116 => 57,  111 => 54,  93 => 39,  90 => 38,  84 => 35,  79 => 31,  73 => 27,  70 => 25,  68 => 24,  63 => 20,  53 => 17,  50 => 16,  46 => 15,  42 => 13,  33 => 9,  27 => 6,  19 => 1,);
    }
}
/* {{header}}*/
/* <div id="content">*/
/* 	<div class="page-header">*/
/* 		<div class="container-fluid">*/
/* 			<div class="pull-right">*/
/* 				<button type="submit" form="form-module" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary">*/
/* 					<i class="fa fa-save"></i>*/
/* 				</button>*/
/* 				<a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default">*/
/* 					<i class="fa fa-reply"></i>*/
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
/* 										<div class="list-group">*/
/* 											<input disabled type="checkbox" name="{{itdaat_oc_attribute_value.value}}" value="{{itdaat_oc_attribute_value.value}}" id="{{itdaat_oc_attribute_value.value}}"/>*/
/* 											<label class="list-group-item" for="{{itdaat_oc_attribute_value.value}}">&nbsp;{{itdaat_oc_attribute_value.value}}</label>*/
/* 										</div>*/
/* 									{% endfor %}*/
/* 								</div>*/
/* 							</div>*/
/* 						</div>*/
/* */
/* 						<div class="col-sm-6" style="border-left: 1px solid black;">*/
/* 							<div class="col-sm-12 text-center">*/
/* 								<h3>New Attributes</h3>*/
/* 								<br>*/
/* 							</div>*/
/* 							<div class="col-sm-12" style="margin-bottom:30px">*/
/* 								<div class="col-sm-11">*/
/* 									<div class="input-group">*/
/* 										<input type="text" class="form-control" placeholder="Search" id="txtSearch"/>*/
/* 										<div class="input-group-btn">*/
/* 											<button class="btn btn-primary" type="submit" name="search" value="search">*/
/* 												<i class="fa fa-search"></i>*/
/* 											</button>*/
/* 										</div>*/
/* 									</div>*/
/* 								</div>*/
/* 								<div class="col-sm-1">*/
/* 									<button class="btn btn-primary" type="submit" name="action" value="new_itdaat_attribute">*/
/* 										<i class="fa fa-plus" aria-hidden="true"></i>*/
/* 									</button>*/
/* 								</div>*/
/* 							</div>*/
/* 							<div*/
/* 								class="col-sm-12 itdaat-container-overflow">*/
/* 								{% for itdaat_attribute in itdaat_attributes %}*/
/* 									<div class="col-sm-12">*/
/* 										<button  type="submit" name="action" value="connect_itdaat_attribute|{{itdaat_attribute.id}}" style="all: unset; width: 100%;"  class="btn btn-primary btn-lg btn-block">*/
/* 											<div class="list-group">*/
/* 												<a class="list-group-item ">*/
/* 													<h4 class="list-group-item-heading">{{itdaat_attribute.name}}</h4>*/
/* 													<p class="list-group-item-text">{{itdaat_attribute.value}}</p>*/
/* 												</a>*/
/* 											</div>*/
/* 										</button>*/
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
