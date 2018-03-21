<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");
?>

<?
//Удаление подписок из битрикса, по списку из файла
CModule::IncludeModule('subscribe');

$dataFile = file_get_contents($_SERVER["DOCUMENT_ROOT"] . '/dev2/emails.txt');

$mailsArr = explode("\n", $dataFile);

echo "<p>Обрабатываем адреса</p>";

foreach($mailsArr as $mailItem):
	$mailItem = trim($mailItem);
	echo "<p>";
	echo "[$mailItem]";
	$subsInfo = CSubscription::GetByEmail($mailItem);

	if($subsInfo->ExtractFields("str_")):
		$subId = (integer)$str_ID;
		echo " ID подписки: $subId";

		CSubscription::Delete($subId);
		echo "Подписка удалена";

	else:
		echo " Подписчик не найден";
	endif;

	echo "</p>";
	//print_r($subId);
endforeach;

//print_r($mailsArr);

?>

  
  <?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>