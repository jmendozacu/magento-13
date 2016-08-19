<?php
/**
 * Venustheme
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Venustheme EULA that is bundled with
 * this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.venustheme.com/LICENSE-1.0.html
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade the extension
 * to newer versions in the future. If you wish to customize the extension
 * for your needs please refer to http://www.venustheme.com/ for more information
 *
 * @category   Ves
 * @package    Ves_FAQ
 * @copyright  Copyright (c) 2014 Venustheme (http://www.venustheme.com/)
 * @license    http://www.venustheme.com/LICENSE-1.0.html
 */

/**
 * Ves FAQ Extension
 *
 * @category   Ves
 * @package    Ves_FAQ
 * @author     Venustheme Dev Team <venustheme@gmail.com>
 */
class Ves_FAQ_Block_Adminhtml_Answer_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        
        $this->_objectId = 'id';
        $this->_blockGroup = 'ves_faq';
        $this->_controller = 'adminhtml_answer';
        
        $this->_updateButton('save', 'label', Mage::helper('ves_faq')->__('Save Answer'));
        $this->_updateButton('delete', 'label', Mage::helper('ves_faq')->__('Delete Answer'));
        
        $this->_addButton('saveandcontinue', array(
            'label'        => Mage::helper('adminhtml')->__('Save And Continue Edit'),
            'onclick'    => 'saveAndContinueEdit()',
            'class'        => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('faq_content') == null)
                    tinyMCE.execCommand('mceAddControl', false, 'faq_content');
                else
                    tinyMCE.execCommand('mceRemoveControl', false, 'faq_content');
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }
    
    /**
     * get text to show in header when edit an item
     *
     * @return string
     */
    public function getHeaderText()
    {
        return '';

        
        if (Mage::registry('answer_data')
            && Mage::registry('answer_data')->getId()
        ) {
            return Mage::helper('ves_faq')->__("Edit Answer: '%s'",
                                                $this->htmlEscape(Mage::registry('answer_data')->getTitle())
            );
        }
        return Mage::helper('ves_faq')->__('Add Answer');
    }
}