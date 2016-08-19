<?php
class Ves_BlockBuilder_Block_Adminhtml_Blockbuilder_Edit_Tab_Design extends Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {

        $form = new Varien_Data_Form();
        $model = Mage::registry("block_data");
        $this->setForm($form);
        $fieldset = $form->addFieldset("block_data", array("legend" => Mage::helper("ves_blockbuilder")->__("Desgin Block")));

        $fieldset->addField("prefix_class", "text", array(
            "label" => Mage::helper("ves_blockbuilder")->__("Prefix Class"),
            "class" => "form-control",
            "name" => "prefix_class",
        ));


        $fieldset->addField('container', 'select', array(
            'label' => Mage::helper('ves_blockbuilder')->__('Enable Container'),
            'options'   => array(
                '2' => Mage::helper('cms')->__('Disabled'),
                '1' => Mage::helper('cms')->__('Enabled')
            ),
            'name' => 'container',
            "class" => "form-control",
            "required" => false
        ));

        $lastEvent = "";
        //Here is what is interesting us          
        //We add a new type, our type, to the fieldset
        //We call it extended_label
        $fieldset->addType('extended_editor','Ves_Base_Lib_Varien_Data_Form_Element_ExtendedEditor');

        $fieldset->addField('block_editor', 'extended_editor', array(
            'label'         => 'Block Editor',
            'name'          => 'block_editor',
            'block_id'      => 'wpo-widgetform',
            'model_data'    => $model,
            'required'      => false,
            'value'         => $this->getLastEventLabel($lastEvent),
            'label_style'   =>  'font-weight: bold;color:red;',
        ));


        if (Mage::getSingleton("adminhtml/session")->getBlockData()) {
            $form->setValues(Mage::getSingleton("adminhtml/session")->getBlockData());
            Mage::getSingleton("adminhtml/session")->getBlockData(null);
        } elseif ($model) {
            $form->setValues($model->getData());
        }

        return parent::_prepareForm();
    }
}
