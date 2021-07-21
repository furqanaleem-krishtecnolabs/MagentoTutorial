<?php


namespace Practice\CustomerLogin\Block\Adminhtml\Form\Field;


use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;
use Magento\Framework\DataObject;
use Magento\Framework\Exception\LocalizedException;

class Reasons extends AbstractFieldArray
{
    /**
     * @var string
     */
    protected $_template = 'Practice_CustomerLogin::system/config/form/field/array.phtml';

    /**
     * Prepare rendering the new field by adding all the needed columns
     */
    protected function _prepareToRender()
    {
        $this->addColumn('id', ['label' => __('ID'), 'class' => 'required-entry', 'size' => '1px']);
        $this->addColumn('reason', ['label' => __('Reason'), 'class' => 'required-entry']);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add New');
    }

    /**
     * Render array cell for prototypeJS template
     *
     * @param string $columnName
     * @return string
     * @throws \Exception
     */
    public function renderCellTemplate($columnName)
    {
        $value = $columnName;
        if (empty($this->_columns[$columnName])) {
            throw new \Exception('Wrong column name specified.');
        }
        $column = $this->_columns[$columnName];
        $inputName = $this->_getCellInputElementName($columnName);

        if ($column['renderer']) {
            return $column['renderer']->setInputName(
                $inputName
            )->setInputId(
                $this->_getCellInputElementId('<%- _id %>', $columnName)
            )->setColumnName(
                $columnName
            )->setColumn(
                $column
            )->toHtml();
        }

        $disabled = '';
        if ($columnName == 'id') {
            $disabled = 'readonly';
        }

        return '<input type="text" id="' . $this->_getCellInputElementId(
                '<%- _id %>',
                $columnName
            ) .
            '"' .
            ' name="' .
            $inputName .
            '" value="<%- ' .
            $value .
            ' %>" '.$disabled.' ' .
            ($column['size'] ? 'size="' .
                $column['size'] .
                '"' : '') .
            ' class="' .
            (isset(
                $column['class']
            ) ? $column['class'] : 'input-text') . '"' . (isset(
                $column['style']
            ) ? ' style="' . $column['style'] . '"' : '') . '/>';
    }
}