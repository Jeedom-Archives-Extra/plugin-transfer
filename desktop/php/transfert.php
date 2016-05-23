<?php
if (!isConnect('admin')) {
	throw new Exception('{{401 - Accès non autorisé}}');
}
sendVarToJS('eqType', 'transfert');
$eqLogics = eqLogic::byType('transfert');
?>

<div class="row row-overflow">
  <div class="col-lg-2 col-md-3 col-sm-4">
    <div class="bs-sidebar">
      <ul id="ul_eqLogic" class="nav nav-list bs-sidenav">
        <a class="btn btn-default eqLogicAction" style="width : 100%;margin-top : 5px;margin-bottom: 5px;" data-action="add"><i class="fa fa-plus-circle"></i> {{Ajouter un transfert}}</a>
        <li class="filter" style="margin-bottom: 5px;"><input class="filter form-control input-sm" placeholder="{{Rechercher}}" style="width: 100%"/></li>
        <?php
foreach ($eqLogics as $eqLogic) {
	echo '<li class="cursor li_eqLogic" data-eqLogic_id="' . $eqLogic->getId() . '"><a>' . $eqLogic->getHumanName(true) . '</a></li>';
}
?>
     </ul>
   </div>
 </div>

 <div class="col-lg-10 col-md-9 col-sm-8 eqLogicThumbnailDisplay" style="border-left: solid 1px #EEE; padding-left: 25px;">
  <legend>{{Mes transfert}}</legend>

  <div class="eqLogicThumbnailContainer">
    <div class="cursor eqLogicAction" data-action="add" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >
     <center>
      <i class="fa fa-plus-circle" style="font-size : 7em;color:#94ca02;"></i>
    </center>
    <span style="font-size : 1.1em;position:relative; top : 23px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;color:#94ca02"><center>{{Ajouter}}</center></span>
  </div>
  <?php
foreach ($eqLogics as $eqLogic) {
	echo '<div class="eqLogicDisplayCard cursor" data-eqLogic_id="' . $eqLogic->getId() . '" style="background-color : #ffffff; height : 200px;margin-bottom : 10px;padding : 5px;border-radius: 2px;width : 160px;margin-left : 10px;" >';
	echo "<center>";
	echo '<img src="plugins/transfert/doc/images/template_icon.png" height="105" width="95" />';
	echo "</center>";
	echo '<span style="font-size : 1.1em;position:relative; top : 15px;word-break: break-all;white-space: pre-wrap;word-wrap: break-word;"><center>' . $eqLogic->getHumanName(true, true) . '</center></span>';
	echo '</div>';
}
?>
</div>
</div>

<div class="col-lg-10 col-md-9 col-sm-8 eqLogic" style="border-left: solid 1px #EEE; padding-left: 25px;display: none;">
  <div class="row">
    <div class="col-lg-6">
      <form class="form-horizontal">
        <fieldset>
          <legend><i class="fa fa-arrow-circle-left eqLogicAction cursor" data-action="returnToThumbnailDisplay"></i> {{Général}}  <i class='fa fa-cogs eqLogicAction pull-right cursor expertModeVisible' data-action='configure'></i></legend>
          <div class="form-group">
            <label class="col-sm-3 control-label">{{Nom de l'équipement transfert}}</label>
            <div class="col-sm-3">
              <input type="text" class="eqLogicAttr form-control" data-l1key="id" style="display : none;" />
              <input type="text" class="eqLogicAttr form-control" data-l1key="name" placeholder="{{Nom de l'équipement transfert}}"/>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-3 control-label" >{{Objet parent}}</label>
            <div class="col-sm-3">
              <select id="sel_object" class="eqLogicAttr form-control" data-l1key="object_id">
                <option value="">{{Aucun}}</option>
                <?php
foreach (object::all() as $object) {
	echo '<option value="' . $object->getId() . '">' . $object->getName() . '</option>';
}
?>
             </select>
           </div>
         </div>
         <div class="form-group">
          <label class="col-sm-3 control-label" >{{Activer}}</label>
          <div class="col-sm-9">
           <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Activer}}" data-l1key="isEnable" checked/>
           <input type="checkbox" class="eqLogicAttr bootstrapSwitch" data-label-text="{{Visible}}" data-l1key="isVisible" checked/>
         </div>
       </div>
       <div class="form-group">
         <label class="col-sm-3 control-label" >{{Service}}</label>
         <div class="col-sm-3">
          <select class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="service">
            <option value="none">{{Aucun}}</option>
            <option value="samba">Samba</option>
          </select>
        </div>
      </div>



    </fieldset>
  </form>

</div>
<div class="col-lg-6">
  <form class="form-horizontal">
    <fieldset>

      <legend>{{Configuration}}</legend>

      <div class="service samba" style="display:none;">
       <div class="form-group">
         <label class="col-sm-3 control-label" >{{IP}}</label>
         <div class="col-sm-3">
          <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="samba::ip" />
        </div>
      </div>
      <div class="form-group">
       <label class="col-sm-3 control-label" >{{Utilisateur}}</label>
       <div class="col-sm-3">
        <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="samba::username" />
      </div>
    </div>
    <div class="form-group">
     <label class="col-sm-3 control-label" >{{Mot de passe}}</label>
     <div class="col-sm-3">
      <input type="password" class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="samba::password" />
    </div>
  </div>
  <div class="form-group">
   <label class="col-sm-3 control-label" >{{Partage}}</label>
   <div class="col-sm-3">
    <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="samba::share" />
  </div>
</div>
<div class="form-group">
 <label class="col-sm-3 control-label" >{{Chemin}}</label>
 <div class="col-sm-3">
  <input class="eqLogicAttr form-control" data-l1key="configuration" data-l2key="samba::path" />
</div>
</div>
</div>

</fieldset>
</form>
</div>
</div>


<legend>{{Commandes}}</legend>
<table id="table_cmd" class="table table-bordered table-condensed">
  <thead>
    <tr>
      <th>{{Nom}}</th><th>{{Action}}</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

<form class="form-horizontal">
  <fieldset>
    <div class="form-actions">
      <a class="btn btn-danger eqLogicAction" data-action="remove"><i class="fa fa-minus-circle"></i> {{Supprimer}}</a>
      <a class="btn btn-success eqLogicAction" data-action="save"><i class="fa fa-check-circle"></i> {{Sauvegarder}}</a>
    </div>
  </fieldset>
</form>

</div>
</div>

<?php include_file('desktop', 'transfert', 'js', 'transfert');?>
<?php include_file('core', 'plugin.template', 'js');?>