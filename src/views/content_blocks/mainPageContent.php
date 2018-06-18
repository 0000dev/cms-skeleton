
            <div class="border-block">
                <span class="head-d clr-d bdr-h"><?=@str_replace('{DOMAIN}', ucfirst($z['name']), HEADING_MAIN_PAGE_CONTENT)?></span>
                <div class="row">
        
            <div class="twelve columns">
                <div class="well-fa pad25 of-x-s">
                    
                    <table>

                    <tr>
                        <th style="text-align: left">HTML тег</th> <th style="text-align: left"><?=ucfirst($z['name'])?> Контент</th> <th style="text-align: left">Анализ</th>
                    </tr>
                            <?php

                                    $note_message = '';

                                    // checking presence and length of meta tags content (title, description)

                                    if (isset($z['title'])) {

                                            echo '<tr> <td> Title: </td> <td>'.$z['title'].'</td><td>'.(strlen($z['title'])>70 ? '	<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>' : ' Следует дополнить' ).'</td></tr>';

                                            if (strlen($z['title'])<=70)
                                                    $note_message.='<br>&#8226; '.$this->tagReplacer(PAGE_CONTENT_NOTICE_TITLE_EXISTS_BUT_SHORT, $z, ['{CHARSCOUNT}'],[strlen($z['title'])]);

                                    }
                                    else {

                                            $note_message.= '<br>&#8226; '.$this->tagReplacer(PAGE_CONTENT_NOTICE_NO_TITLE, $z);
                                            echo '<tr> 
                                                            <td> Title: </td> 
                                                            <td> Not set </td>
                                                            <td><img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> N\a</td>
                                                      </tr>'; 
                                    }

                                    if (isset($z['description']))  {

                                            echo '<tr> 
                                                            <td> Description: </td>
                                                            <td>'.$z['description'].'</td>
                                                            <td>'.(strlen($z['description'])>100 ? '	<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>' : ' Следует дополнить' ).'</td>
                                                      </tr>';

                                            if (strlen($z['description'])<=120)
                                                    $note_message.= '<br>&#8226; '.$this->tagReplacer(PAGE_CONTENT_NOTICE_DESCR_EXISTS_BUT_SHORT, $z, ['{CHARSCOUNT}'],[strlen($z['title'])]);
                                    }
                                    else {

                                            echo '<tr>
                                                            <td> Description: </td>
                                                            <td> Не определен </td>
                                                            <td><img src="'.HTML_RESOURCES_FOLDER.'/img/warning.png"/> N\a</td>
                                                      </tr>';

                                            $note_message.= '<br>&#8226; '.$this->tagReplacer(PAGE_CONTENT_NOTICE_NO_DESCR, $z);
                                    }

                                    // checking presence and length of H tags content

                                    if (isset($z['h1'])) echo '<tr> <td> H1: </td> <td>'.$z['h1'].'</td><td>'.(strlen($z['h1'])>50 ? '	<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>' : 'Следует дополнить' ).'</td></tr>';

                                    if (isset($z['h2'])) echo '<tr> <td> H2: </td> <td>'.$z['h2'].'</td><td>'.(strlen($z['h2'])>50 ? '	<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>' : 'Следует дополнить' ).'</td></tr>';

                                    if (isset($z['h3'])) echo '<tr> <td> H3: </td> <td>'.$z['h3'].'</td><td>'.(strlen($z['h3'])>50 ? '	<img src="'.HTML_RESOURCES_FOLDER.'/img/ok.png"/>' : 'Следует дополнить' ).'</td></tr>';

                                    if (isset($z['h1']) or isset($z['h2']) or isset($z['h3'])) {

                                            if (strlen($z['h1'])<=50 or strlen($z['h2'])<=50 or strlen($z['h3'])<=50)
                                                    $note_message.='<br>&#8226; '.PAGE_CONTENT_HEADINGS_ISSUE;	

                                            // str_replace('{CHARSCOUNT}', replace, PAGE_CONTENT_HEADINGS_ISSUE)
                                    }

                            ?>

                            <tr> <td> About</td> <td colspan="2"><?=$this->mb_ucfirst(preg_replace('/^[^a-zа-яА-ЯA-Z]+/u', '', $z['text']), 'UTF-8')?> </td></tr>
                    </table>
                </div>
            </div>
            
            <div class="twelve columns">
 

		<?php if (strlen($note_message)>0): ?>

			<div class="alert alert-warning" role="alert" >
                            <div class="pretxt">
                                <?=PAGE_CONTENT_ISSUE_TITLE.$note_message?>
                            </div>
			</div>

		<?php endif; ?>
        </div>
    </div>
</div>