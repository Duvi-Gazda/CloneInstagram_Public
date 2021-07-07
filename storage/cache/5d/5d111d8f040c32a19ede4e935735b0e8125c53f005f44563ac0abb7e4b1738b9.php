<?php

/* extension/module/itdaat_attributer.twig */
class __TwigTemplate_cba64be90b1a95f83d3f45923477020edbc9f3e7fd29decf003de513a8b7da84 extends Twig_Template
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
           <div class=\"col-sm-12\">
            <div class=\"col-sm-6\">
                text
            </div>

            <div class=\"col-sm-6\">
                text right
            </div>

          </div>
        </form>
      </div>
    </div>
     <div class=\"panel panel-default\">
      <div class=\"panel-body\">
        <form action=\"";
        // line 44
        echo (isset($context["action"]) ? $context["action"] : null);
        echo "\" method=\"post\" enctype=\"multipart/form-data\" id=\"form-module\" class=\"form-horizontal\">
          <div class=\"col-sm-12\">
          <div class=\"col-sm-6\" style=\"border-right: 1px solid black;\">
              <div class=\"col-sm-12 text-center\">
                <h3>Attributes</h3>
              </div>
              <div class=\"col-sm-12\">";
        // line 51
        echo (isset($context["attributes"]) ? $context["attributes"] : null);
        echo "
              </div>
          </div>
          <div class=\"col-sm-6\" style=\"border-left: 1px solid black;\">
            <div class=\"col-sm-12 text-center\">
              <h3>New Attributes</h3>
            </div>";
        // line 68
        echo "
            </div>
          </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>";
        // line 77
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
        return array (  129 => 77,  119 => 68,  110 => 51,  101 => 44,  82 => 28,  79 => 27,  73 => 24,  69 => 22,  62 => 18,  60 => 17,  55 => 13,  45 => 11,  41 => 10,  37 => 8,  31 => 7,  27 => 6,  19 => 1,);
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
/*            <div class="col-sm-12">*/
/*             <div class="col-sm-6">*/
/*                 text*/
/*             </div>*/
/* */
/*             <div class="col-sm-6">*/
/*                 text right*/
/*             </div>*/
/* */
/*           </div>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*      <div class="panel panel-default">*/
/*       <div class="panel-body">*/
/*         <form action="{{ action }}" method="post" enctype="multipart/form-data" id="form-module" class="form-horizontal">*/
/*           <div class="col-sm-12">*/
/*           <div class="col-sm-6" style="border-right: 1px solid black;">*/
/*               <div class="col-sm-12 text-center">*/
/*                 <h3>Attributes</h3>*/
/*               </div>*/
/*               <div class="col-sm-12">*/
/*                 {{attributes}}*/
/*               </div>*/
/*           </div>*/
/*           <div class="col-sm-6" style="border-left: 1px solid black;">*/
/*             <div class="col-sm-12 text-center">*/
/*               <h3>New Attributes</h3>*/
/*             </div>*/
/* {#              {{% for itdaat_attribute in itdaat_attributes %}}#}*/
/* {#                <div class="col-sm-12">#}*/
/* {#                  <div class="list-group">#}*/
/* {#                    <a href="" class="list-group-item ">#}*/
/* {#                      <h4 class="list-group-item-heading">{{itdaat_attribute.name}}</h4>#}*/
/* {#                      <p class="list-group-item-text">{{itdaat_attribute.values}}</p>#}*/
/* {#                    </a>#}*/
/* {#                  </div>#}*/
/* {#              {{% endfor %}}#}*/
/*               {# {{itdaat_attributes}} #}*/
/* */
/*             </div>*/
/*           </div>*/
/*           </div>*/
/*         </form>*/
/*       </div>*/
/*     </div>*/
/*   </div>*/
/* </div>*/
/* {{ footer }}*/
