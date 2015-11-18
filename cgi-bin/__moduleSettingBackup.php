<h3>Backup</h3>
<p>Here you are able to do a backup of your data project.</p>

<div class="row" id="settingsSourcesInsertion">
	<a id="settingBackupDo" class="col s3 offset-s1 waves-effect waves-light btn-large"><i class="material-icons left">history</i>Backup</a>
</div>

<p>List of backups</p>
<div class="col 12" id="settingBackupList">
	<?
		$dir = 'backup';
		$files = scandir($dir);
		$backups = [];
		foreach($files as $value) {
			$v = explode(".", $value)[0];
			if(is_numeric($v)) {
				?>
					<p>
						<input name="backup" id="<? echo $v ?>" type="radio"/>
						<label for="<? echo $v ?>"><? echo 'Backup del ' . substr($v, 0, 4) . '-' . substr($v, 4, 2) . '-' . substr($v, 6, 2) . ' eseguito alle ' . substr($v, 8, 2) . ':' . substr($v, 10, 2) .':'. substr($v, 12, 2) ?></label>
					</p>
				<?
			}
		}

	?>
</div>
<div class="row" id="settingsSourcesInsertion">
	<a id="settingBackupRestore" class="col s3 offset-s1 waves-effect waves-light btn-large"><i class="material-icons left">history</i>Restore</a>
</div>