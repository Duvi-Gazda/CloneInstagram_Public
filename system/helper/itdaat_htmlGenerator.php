<?php
trait itdaat_htmlGenerator {

    
    /**
     * generateBreadcrumbs
     * generates breadcrumbs for
     * @param  mixed $data
     * @param  mixed $moduleLink
     * @return void
     */
    protected function generateBreadcrumbs(&$data, $moduleLink){
        $data['breadcrumbs'] = array();
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', $this->userToken, true)
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_extension'),
			'href' => $this->url->link('marketplace/extension', $this->userToken . '&type=module', true)
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link($moduleLink, $this->userToken , true)
		);
    }
    /**
    * addInputText
    * inputess the text
    * @param  mixed $name - name of the input
    * @param  mixed $value - array of values ['key' => 'value']
    * @param  mixed $label - text label
    * @param  mixed $id - id of the input (for HTML)
    * @param  mixed $data_index - index in the data array
    * @return string
    */
   protected function addInputText(string $name, $value,&$data, string $label = '', string $id = '', string $data_index = 'itdaatInputs'):string{
       $res = '<div class="form-group">';
       // $col_sm_input - size of the input.
       // it is setted in the value because it is possible to change the size if label is not setted
       $col_sm_input = '12';
       // if there is no label
       if ($label != ''){
           $res .= '<label class="col-sm-2 control-label" for="input-photo-for-categories-license">'. $label .' </label>';
           $col_sm_input = '10';
       }
       $id = $id == ''? $name . '_id': $id;
       $res .= '<div class="col-sm-'.$col_sm_input.'">
       <input name="'.$name.'" id="input-photo-for-categories-license" class="form-control" value="'. $value .'"/>
       </div>';
       $res .= '</div>';
       // write to the $data array link 
       $data[$data_index] .= $res;
       return $res;
   }    
   /**
    * addInputSelect
    *
    * @param  mixed $name - name of the input
    * @param  mixed $values - array of values ['key' => 'value']
    * @param  mixed $selected - selected KEY (in array)
    * @param  mixed $data - link to opencarts data array in controller
    * @param  mixed $label - text label for the input
    * @param  mixed $id - id of the input (for HTML)
    * @param  mixed $keyLanguage - if in the values array are setted only keys of the language text
    * - True if only keys.
    * - False if keys and values
    * @param  mixed $data_index - index in the data array
    * @return string
    */
   protected function addInputSelect(string $name,array $values,$selected,&$data,string $label = '', string $id = '', bool $keyLanguage = false, string $data_index = 'itdaatInputs'):string{
       $res = '<div class="form-group">';
       $col_sm_input = '12';
       if($label != ''){
           $res .= '<label class="col-sm-2 control-label" for="'.$name.'">'. $label .' </label>';
           $col_sm_input = '10';
        }
        $res .= '<div class="col-sm-'.$col_sm_input.'">
        <select name="'. $name .'" id="'.$id.'" class="form-control">';
        if($keyLanguage){
            $this->generateArrKeyValByKeysArr($values);
        }else{
            $this->generateArrKeyValByKeysArr($values, true);
        }
        foreach($values as $key =>$value){
            if($selected == $key){
               $res .= '<option value="'.$key.'" selected="">' . $value .'</option>';
           }else{
               $res .= '<option value="'.$key.'">' . $value .'</option>';
           }
       }
       $res .= '</select> </div></div>';
       $data[$data_index] = isset($data[$data_index]) ? $data[$data_index] : '';
       $data[$data_index] .= $res;
       return $res;
   }    
   /**
    * addSaveSettingsButton
    * sets data for save button
    * @param  mixed $data
    * @param  mixed $pathToModule
    * @return void
    */
   protected function addSaveSettingsButton(&$data, $pathToModule ){
        $data['action'] = $this->url->link($pathToModule, 'user_token=' . $this->session->data['user_token'] . '&updated=true', true);
   }   
   /**
    * addCancelButton
    * sets data to cancel button
    * @param  mixed $data
    * @param  mixed $pathToModule
    * @return void
    */
   protected function addCancelButton(&$data, $pathToModule ){
		$data['cancel'] = $this->url->link($pathToModule, 'user_token=' . $this->session->data['user_token'] . '&type=module', true);
   }
    /**
    * generateArrKeyValByKeysArr
    * get array of keys and takes from language values and sets to 
    * link value
    * @param  mixed $keys
    * @return array
    */
   private function generateArrKeyValByKeysArr(array &$values,$keys = false):array{
       $res = array();
       foreach ($values as $key => $value){
           $res[$keys ? $key: $value] = $this->language->get($value);
       }
       return $values = $res;
   } 
}