<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Proparking
 * @author     Synapse India  <info@synapseindia.com>
 * @copyright  2020 Synapse India
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access
defined('_JEXEC') or die;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Layout\LayoutHelper;

$canEdit = JFactory::getUser()->authorise('core.edit', 'com_proparking');

if (!$canEdit && JFactory::getUser()->authorise('core.edit.own', 'com_proparking'))
{
	$canEdit = JFactory::getUser()->id == $this->item->created_by;
}
?>

<div class="item_fields">

	<table class="table">
		

		<tr>
			<th><?php echo Text::_('COM_PROPARKING_FORM_LBL_PARKINGLOT_PARKINGLOT_NAME'); ?></th>
			<td><?php echo $this->item->parkinglot_name; ?></td>
		</tr>

		<tr>
			<th><?php echo Text::_('COM_PROPARKING_FORM_LBL_PARKINGLOT_PARKINGLOT_LOCATION'); ?></th>
			<td><?php echo $this->item->parkinglot_location; ?></td>
		</tr>

	</table>

</div>

<?php if($canEdit && $this->item->checked_out == 0): ?>

	<a class="btn" href="<?php echo JRoute::_('index.php?option=com_proparking&task=parkinglot.edit&id='.$this->item->id); ?>"><?php echo Text::_("COM_PROPARKING_EDIT_ITEM"); ?></a>

<?php endif; ?>

<?php if (JFactory::getUser()->authorise('core.delete','com_proparking.parkinglot.'.$this->item->id)) : ?>

	<a class="btn btn-danger" href="#deleteModal" role="button" data-toggle="modal">
		<?php echo Text::_("COM_PROPARKING_DELETE_ITEM"); ?>
	</a>

	<div id="deleteModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
		<div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			<h3><?php echo Text::_('COM_PROPARKING_DELETE_ITEM'); ?></h3>
		</div>
		<div class="modal-body">
			<p><?php echo Text::sprintf('COM_PROPARKING_DELETE_CONFIRM', $this->item->id); ?></p>
		</div>
		<div class="modal-footer">
			<button class="btn" data-dismiss="modal">Close</button>
			<a href="<?php echo JRoute::_('index.php?option=com_proparking&task=parkinglot.remove&id=' . $this->item->id, false, 2); ?>" class="btn btn-danger">
				<?php echo Text::_('COM_PROPARKING_DELETE_ITEM'); ?>
			</a>
		</div>
	</div>

<?php endif; ?>