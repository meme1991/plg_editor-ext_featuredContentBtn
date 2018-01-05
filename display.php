<?php
/**
 * @version    1.0.0
 * @package    SPEDI Featured Content Button
 * @author     SPEDI srl - http://www.spedi.it
 * @copyright  Copyright (c) Spedi srl.
 * @license    GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

  define( '_JEXEC', 1 );
  define( 'DS', DIRECTORY_SEPARATOR );
  define( 'JPATH_BASE', realpath( '..'.DS.'..'.DS.'..'.DS ) );
  require_once ( JPATH_BASE.DS.'includes'.DS.'defines.php' );
  require_once ( JPATH_BASE.DS.'includes'.DS.'framework.php' );

  $mainframe = JFactory::getApplication('administrator');
  jimport( 'joomla.plugin.plugin' );
  $ih_name = addslashes( $_GET['ih_name'] );

  $db = JFactory::getDbo();
  $query = $db->getQuery(true);
  $query->select($db->quoteName(array('id', 'title')));
  $query->from($db->quoteName('#__content'));
  $query->where($db->quoteName('state') . ' = '. $db->quote(1));
  $query->order('ordering ASC');
  $db->setQuery($query);
  $results = $db->loadObjectList();
 ?>

 <html>
  <head>
    <title><?php echo JText::_('Featured Content - (by SPEDI srl)') ?></title>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="dist/style.min.css" />
    <script type="text/javascript">
      function InsertHtmlDialogokClick() {
        // content id
        var content_id = document.getElementById("content_id").value;
        content_id = "content_id="+content_id;
        // color featured
        var color = document.getElementById("color").value;
        if (color != '#007bff') { // se diverso da colore di default $primary = #007bff
          color = "|color="+color;
        } else{
          color = '';
        }

        var tag = "{featuredContent "+content_id+color+"}";

        window.parent.jInsertEditorText(tag, '<?php echo $ih_name ?>');
        window.parent.jModalClose();
       }

       function InsertHtmlDialogcancelClick() {
         window.parent.jModalClose();
       }
    </script>

   <style media="screen">
     @import url('https://fonts.googleapis.com/css?family=Titillium+Web:,400,400i,600');
     table{
       font-family: 'Titillium Web', sans-serif;
     }
     td{
       vertical-align: middle !important;
     }
     fieldset{
       border: 0 !important;
     }
    .btn{
      cursor: pointer;
    }

   </style>
   </head>
   <body>
     <form name="featuredContentForm" onSubmit="return false;">
       <fieldset>
         <table class="table">
           <tr>
             <td><label for="content_id" class="col-form-label">Seleziona un articolo</label></td>
             <td>
               <select name="content_id" id="content_id" class="input form-control form-control-sm">
                 <?php foreach ($results as $cat) : ?>
                 <option value="<?php echo $cat->id ?>"><?php echo $cat->title ?></option>
                 <?php endforeach; ?>
               </select>
             </td>
           </tr>
           <tr>
             <td><label for="color" class="col-form-label">Scegli un colore</label></td>
             <td>
               <input type="color" class="form-control form-control-sm" id="color" name="color" value="#007bff">
             </td>
           </tr>
         </table>
       </fieldset>
       <fieldset>
         <table class="table">
           <tr>
             <td>
               <input type="submit" class="btn btn-primary" value="<?= JText::_('Inserisci il codice') ?>" onClick="InsertHtmlDialogokClick()">
               <input type="button" class="btn btn-secondary" value="<?= JText::_('Annulla') ?>" onClick="InsertHtmlDialogcancelClick()">
             </td>
           </tr>
         </table>
       </fieldset>
     </form>
   </body>
 </html>
