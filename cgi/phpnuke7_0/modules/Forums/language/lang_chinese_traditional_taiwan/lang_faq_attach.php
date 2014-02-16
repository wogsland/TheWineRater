<?php
/************************************************************************** 
 *                            lang_faq_attach.php [Chinese]
 *                              -------------------
 *     begin                : Thu Feb 07 2002
 *     copyright            : (C) 2002 Meik Sievertsen
 *     email                : acyd.burn@gmx.de
 *     Translation          : Sp Lin , splin@cpalm.idv.tw (For Attachment Mod 2.32)
 *     $Id: lang_faq_attach.php,v 1.15 2002/09/16 18:38:29 meik Exp $
 *
 ****************************************************************************/

/***************************************************************************
 *
 *   This program is free software; you can redistribute it and/or modify
 *   it under the terms of the GNU General Public License as published by
 *   the Free Software Foundation; either version 2 of the License, or
 *   (at your option) any later version.
 *
 ***************************************************************************/

$faq[] = array("--","附加檔案");

$faq[] = array("如何新增附加檔案?", "當你發表新文章時, 您可以新增附加檔案. 您應該會在輸入文字區快下看到 <i>附加檔案</i> 的表格. 您只要按下 <i>瀏覽...</i> 鍵, 檔案總管的視窗就會跳出. 瀏覽您所要附加的檔案, 選擇好檔案後按下確定, 或者雙擊該檔即可. 如果您要詳細說明檔案, 在 <i>檔案註解</i> 欄位中填寫即可，檔案註解將顯示為該附加檔案連結名稱. 如果您不想加入註解, 系統會自動以檔名代替. 如果管理員允許, 您將可以依照先前方式上傳數個檔案, 直至達到上限為止.<br/><br/>管理員也會設定附加檔案的大小上限, 定義副檔名和 MIME 類型. 管理員並保有刪除您附加檔案的權利.<br/><br/>請注意管理員將不負任何資料損失的責任.");

$faq[] = array("如何在文章發表後新增附加檔案?", "欲在文章發表後新增附加檔案, 你必須編輯您的文章, 並且照著上述步驟. 新的附加檔案會在您按下 <i>送出</i> 鍵後加入編輯過的文章中.");

$faq[] = array("如何刪除附加檔案?", "欲刪除附加檔案, 您必須編輯您原本的文章, 並且在 <i>已加入的附加檔案</i> 表格中, 按下您想刪除的附加檔案旁的 <i>刪除附加檔案</i> 鍵. 該附加檔案將會在您按下 <i>送出</i> 後被刪除.");

$faq[] = array("如何更新檔案註解?", "欲更新檔案註解, 您必須編輯您原本的文章, 並且在 <i>已加入的附加檔案</i> 表格中, 按下您想更新註解的附加檔案旁的 <i>更新註解</i> 鍵. 該附加檔案的注解將會在您按下 <i>送出</i> 後被更新.");

$faq[] = array("為何我在文章中看不見附加的檔案?", "最有可能的原因是, 該附加檔案或其 MIME 類型已經被管理員關閉, 或者由於某些因素, 該附加檔案已經被版主或管理員刪除.");

$faq[] = array("為何我無法新增附加檔案?", "在某些討論區, 只有部分群組或使用者可以新增附加檔案. 欲新增附加檔案, 您必須取得授權, 而只有版主和管理員有這個權力可以調整您的權限, 請與他們聯繫.");

$faq[] = array("我已獲得授權, 但為何還是無法新增附加檔案?", "管理員限制了附加檔案的檔案大小, 副檔名和 MIME 類型. 版主或者管理員可能變更了您的權限, 或者關閉了某個討論區的附加檔案功能. 當您嘗試新增附加檔案時, 您應該會看到一些錯誤訊息. 如果沒有, 或許您該考慮通知版主或者管理員.");

$faq[] = array("為何我無法刪除附加的檔案?", "在某些討論區, 刪除附加檔案可能受限於部分使用者及群組. 欲刪除附加檔案, 您必須取得授權, 而只有版主和管理員有這個權力可以調整您的權限, 請與他們聯繫.");

$faq[] = array("為何我無法下載/觀看附加的檔案?", "在某些討論區, 下載/觀看附加檔案可能受限於部分使用者及群組. 欲下載/觀看附加檔案, 您必須取得授權, 而只有版主和管理員有這個權力可以調整您的權限, 請與他們聯繫.");

$faq[] = array("我該向誰反映違法的附加檔案?", "您應該立即通知網站管理員. 如果您無法得知誰是網站管理員, 您應該先通知任何一個討論區的版主, 並且詢問管理員的下落. 如果您依然沒有得到任何回應, 您應該與該網域的所有人聯繫 (WHOIS 搜尋) 或者, 這個網站是架設在免費的伺服器上 (例如: yahoo, free.fr, f2s.com, etc.), 則應通知其管理團隊或者專門的部門. 請特別注意, phpBB 團隊將完全不負任何責任, 並且沒有任何能力控制這個討論版將被如何使用. 因為任何法律上的問題而聯繫 phpBB 團隊是非常沒有意義的, 除非是直接關於 phpbb.com 網站或者 phpBB 程式模組本身. 如果您曾經寄信通知 phpBB 團隊關於其他人使用這個程式, 您將會得到冷淡的回應, 或者不會接到回應.");

?>