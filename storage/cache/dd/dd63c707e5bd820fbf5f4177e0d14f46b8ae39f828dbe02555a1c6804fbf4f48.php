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
  <div class=\"page-header\">
    <div class=\"container-fluid\">
      <div class=\"pull-right\">
        <button type=\"submit\" form=\"form-module\" data-toggle=\"tooltip\" title=\"";
        // line 6
        echo (isset($context["button_save"]) ? $context["button_save"] : null);
        echo "\" class=\"btn btn-primary\"><i class=\"fa fa-save\"></i></button>
        <a href=\"";
        // line 7
        echo (isset($context["cancel"]) ? $context["cancel"] : null);
        echo "\" data-toggle=\"tooltip\" title=\"";
        echo (isset($context["button_cancel"]) ? $context["button_cancel"] : null);
        echo "\" class=\"btn btn-default\"><i class=\"fa fa-reply\"></i></a></div>
      <h1>";
        // line 8
        echo (isset($context["heading_title"]) ? $context["heading_title"] : null);
        echo "</h1>
      <ul class=\"breadcrumb\">";
        // line 10
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["breadcrumbs"]) ? $context["breadcrumbs"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["breadcrumb"]) {
            // line 11
            echo "        <li><a href=\"";
            echo $this->getAttribute($context["breadcrumb"], "href", array());
            echo "\">";
            echo $this->getAttribute($context["breadcrumb"], "text", array());
            echo "</a></li>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['breadcrumb'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 13
        echo "      </ul>
    </div>
  </div>
  <div class=\"container-fluid\">";
        // line 17
        if ($this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array())) {
            // line 18
            echo "    <div class=\"alert alert-danger alert-dismissible\"><i class=\"fa fa-exclamation-circle\"></i>";
            echo $this->getAttribute((isset($context["error"]) ? $context["error"] : null), "error_warning", array());
            echo "
      <button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>
    </div>";
        }
        // line 22
        echo "    <div class=\"panel panel-default\">
      <div class=\"panel-heading\">
        <h3 class=\"panel-title\"><i class=\"fa fa-pencil\"></i>";
        // line 24
        echo (isset($context["text_edit"]) ? $context["text_edit"] : null);
        echo "</h3>
      </div>
      <div class=\"panel-body\">
        <form action=\"";
        // line 27
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">";
        // line 28
        echo (isset($context["itdaatInputs"]) ? $context["itdaatInputs"] : null);
        echo "
        </form>
      </div>
    </div>
     <div class=\"panel panel-default\" id=\"panel-more-space\">
      <div class=\"panel-body\">
        <form action=\"";
        // line 34
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">
          <div class=\"col-sm-12\">
          <div class=\"col-sm-6\">
              <div class=\"col-sm-12 text-center\">
                <h3>Attributes</h3>
                <br>
              </div>
              <div class=\"col-sm-12\">";
        // line 43
        echo "                <div class=\"col-sm-3\">
                  <h3>";
        // line 44
        echo (isset($context["itdaat_oc_attribute_name"]) ? $context["itdaat_oc_attribute_name"] : null);
        echo "</h3>
                </div>";
        // line 47
        echo "                <div class=\"col-sm-9 overflow-auto itdaat-container\">";
        // line 48
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_oc_attribute_values"]) ? $context["itdaat_oc_attribute_values"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_oc_attribute_value"]) {
            // line 49
            echo "                    <div class=\"list-group\">
                      <input type=\"checkbox\" name=\"CheckBoxInputName\" value=\"";
            // line 50
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" id=\"";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\" />
                      <label class=\"list-group-item\" for=\"";
            // line 51
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "\">&nbsp;";
            echo $this->getAttribute($context["itdaat_oc_attribute_value"], "value", array());
            echo "</label>
                    </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_oc_attribute_value'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 54
        echo "              </div>
              </div>
          </div>

          <div class=\"col-sm-6\" style=\"border-left: 1px solid black;\">
            <div class=\"col-sm-12 text-center\">
              <h3>New Attributes</h3>
              <br>
            </div>";
        // line 64
        $context['_parent'] = $context;
        $context['_seq'] = twig_ensure_traversable((isset($context["itdaat_attributes"]) ? $context["itdaat_attributes"] : null));
        foreach ($context['_seq'] as $context["_key"] => $context["itdaat_attribute"]) {
            // line 65
            echo "                    <div class=\"col-sm-12\">
                    <div class=\"list-group\">
                      <a class=\"list-group-item \">
                        <h4 class=\"list-group-item-heading\">";
            // line 68
            echo $this->getAttribute($context["itdaat_attribute"], "name", array());
            echo "</h4>
                        <p class=\"list-group-item-text\">";
            // line 69
            echo $this->getAttribute($context["itdaat_attribute"], "value", array());
            echo "</p>
                      </a>
                    </div>
                  </div>";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['itdaat_attribute'], $context['_parent'], $context['loop']);
        $context = array_intersect_key($context, $_parent) + $_parent;
        // line 74
        echo "          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>";
        // line 81
        echo (isset($context["footer"]) ? $context["footer"] : null);
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
        return array (  174 => 81,  166 => 74,  156 => 69,  152 => 68,  147 => 65,  143 => 64,  133 => 54,  123 => 51,  117 => 50,  114 => 49,  110 => 48,  108 => 47,  104 => 44,  101 => 43,  91 => 34,  82 => 28,  79 => 27,  73 => 24,  69 => 22,  62 => 18,  60 => 17,  55 => 13,  45 => 11,  41 => 10,  37 => 8,  31 => 7,  27 => 6,  19 => 1,);
    }
}
/* {{header}}*/
/* <div id="content">*/
/*   <div class="page-header">*/
/*     <div class="container-fluid">*/
/*       <div class="pull-right">*/
/*         <button type="submit" form="form-module" data-toggle="tooltip" title="{{ button_save }}" class="btn btn-primary"><i class="fa fa-save"></i></button>*/
/*         <a href="{{ cancel }}" data-toggle="tooltip" title="{{ button_cancel }}" class="btn btn-default"><i class="fa fa-reply"></i></a></div>*/
/*       <h1>{{ heading_title }}</h1>*/
/*       <ul class="breadcrumb">*/
/*         {% for breadcrumb in breadcrumbs %}*/
/*         <li><a href="{{ breadcrumb.href }}">{{ breadcrumb.text }}</a></li>*/
/*         {% endfor %}*/
/*       </ul>*/
/*     </div>*/
/*   </div>*/
/*   <div class="container-fluid">*/
/*     {% if error.error_warning %}*/
/*     <div class="alert alert-danger alert-dismissible"><i class="fa fa-exclamation-circle"></i> {{ error.error_warning }}*/
/*       <button type="button" class="close" data-dismiss="alert">&times;</button>*/
/*     </div>*/
/*     {% endif %}*/
/*     <div class="panel panel-default">*/
/*       <div class="panel-heading">*/
/*         <h3 class="panel-title"><i class="fa fa-pencil"></i> {{ text_edit }}</h3>*/
/*       </div>*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">*/
/*           {{itdaatInputs}}*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*      <div class="panel panel-default" id="panel-more-space">*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">*/
/*           <div class="col-sm-12">*/
/*           <div class="col-sm-6">*/
/*               <div class="col-sm-12 text-center">*/
/*                 <h3>Attributes</h3>*/
/*                 <br>*/
/*               </div>*/
/*               <div class="col-sm-12">*/
/*                 {# heading #}*/
/*                 <div class="col-sm-3">*/
/*                   <h3>{{itdaat_oc_attribute_name}}</h3>*/
/*                 </div>*/
/*                 {# all values #}*/
/*                 <div class="col-sm-9 overflow-auto itdaat-container">*/
/*                   {% for itdaat_oc_attribute_value in itdaat_oc_attribute_values %}*/
/*                     <div class="list-group">*/
/*                       <input type="checkbox" name="CheckBoxInputName" value="{{itdaat_oc_attribute_value.value}}" id="{{itdaat_oc_attribute_value.value}}" />*/
/*                       <label class="list-group-item" for="{{itdaat_oc_attribute_value.value}}">&nbsp;{{itdaat_oc_attribute_value.value}}</label>*/
/*                     </div>*/
/*                   {% endfor %}*/
/*               </div>*/
/*               </div>*/
/*           </div>*/
/* */
/*           <div class="col-sm-6" style="border-left: 1px solid black;">*/
/*             <div class="col-sm-12 text-center">*/
/*               <h3>New Attributes</h3>*/
/*               <br>*/
/*             </div>*/
/*             {# TODO SEARCH IN New attributes #}*/
/*               {% for itdaat_attribute in itdaat_attributes %}*/
/*                     <div class="col-sm-12">*/
/*                     <div class="list-group">*/
/*                       <a class="list-group-item ">*/
/*                         <h4 class="list-group-item-heading">{{itdaat_attribute.name}}</h4>*/
/*                         <p class="list-group-item-text">{{itdaat_attribute.value}}</p>*/
/*                       </a>*/
/*                     </div>*/
/*                   </div>*/
/*               {% endfor %}*/
/*           </div>*/
/*           </div>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
