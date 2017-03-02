<?php
//шаблоны
$wrapDefaultTpl = '[+wrapper+]';
$fbDefaultTpl = '<a class="share" href="#" [+data+]>fb<i class="spring-ico-facebook"></i></a>';
$twDefaultTpl = '<a class="share" href="#" [+data+]>tw<i class="spring-ico-twitter"></i></a>';
$vkDefaultTpl = '<a class="share" href="#" [+data+]>vk<i class="spring-ico-vk"></i></a>';
$ptDefaultTpl = '
<script
    type="text/javascript"
    async defer
    src="//assets.pinterest.com/js/pinit.js"
></script>
<a class="share" href="https://www.pinterest.com/pin/create/button/" data-pin-custom="true" data-pin-do="buttonPin" [+data+]>pt</a>';





//параметры
$noJS = isset($noJS)?$noJS:'0';
$wrapTpl = isset($wrapTpl) ? $wrapTpl : $wrapDefaultTpl;
$fbTpl = isset($fbTpl) ? $fbTpl : $fbDefaultTpl;
$twTpl = isset($twTpl) ? $twTpl : $twDefaultTpl;
$ptTpl = isset($ptTpl) ? $ptTpl : $ptDefaultTpl;
$vkTpl = isset($vkTpl) ? $vkTpl : $vkDefaultTpl;

$imageMultiTvKey = isset($imageMultiTvKey)?$imageMultiTvKey:'image';
$imageTvs = isset($imageTvs) ? $imageTvs : '';
$defaultImage = isset($defaultImage) ? $defaultImage : '';
$docId = isset($docId) ? $docId : $modx->documentIdentifier;
$socials = isset($socials) ? $socials : 'fb,tw,vk,pt';
$socials = explode(',', $socials);
$socialsStr = '';
$lang = $modx->getConfig('_lang');


if(!$noJS){
    $modx->regClientScript("/assets/snippets/share/js/share.js");
}


//получаэм картинку
if(!empty($imageTvs)){
    $imageSrc = '';
    $imageTvs = explode(',',$imageTvs);
    if(is_array($imageTvs)){
        $resp = $modx->getTemplateVars($imageTvs, '*', $docId);
        foreach ($resp as $tv) {
            $imageValues[$tv['name']] = $tv['value'];
        }
        foreach ($imageTvs as $imageTv) {
            if(empty($imageValues[$imageTv])){
                continue;
            }
            $value = $imageValues[$imageTv];
            if(in_array($value,['[]'])){
                continue;
            }
            if(strpos($value,'"fieldValue":')!==false){
                $resp = json_decode($value,true)['fieldValue'];
                if(!empty($resp[0][$imageMultiTvKey])){
                    $imageSrc = $resp[0][$imageMultiTvKey];
                    break;
                }
            }
            else{
                $imageSrc = $value;
                break;
            }
        }
    }
}
if(empty($imageSrc)){
    $imageSrc = $defaultImage;
}
if(!empty($imageSrc)){
    if($imageSrc[0]=='/'){
        $imageSrc = substr($imageSrc,1);
    }
    $imageSrc = $modx->config['site_url'].$imageSrc;
}

if(!empty($socials) && is_array($socials)) {

    $document = $modx->getDocument($docId);
    if (!empty($lang)) {
        $documentTv = $modx->getTemplateVars(array('pagetitle_' . $lang, 'introtext_' . $lang, 'content_' . $lang), '*', $docId);
        foreach ($documentTv as $tv) {
            $documentTvs[$tv['name']] = $tv['value'];
        }
        if (!empty($documentTvs)) {
            $document = array_merge($document, $documentTvs);
        }
    }
    $postfix = empty($lang) ? '' : '_' . $lang;
    $title = $document['pagetitle' . $postfix];
    $introText = $document['introtext' . $postfix];
    $content = $document['content' . $postfix];

    if (empty($introtext)) {
        $introText = $content;
        $introText = strip_tags($introText);
        $introText = substr($introText, 0, 200);

    }
    $siteUrl = $modx->config['site_url'];
    $root = $modx->config['_root'];
    $docUrl = $modx->makeUrl($docId, '', '', '');
    $uri = $siteUrl . $root . substr($docUrl, 1);



    $data = array(
        'title' => $title,
        'description' => $introText,
        'uri' => $uri,
        'poster' => $imageSrc,

    );
    $og = '<meta property="og:title" content="'.$title.'"/>
<meta property="og:description" content="'.$introText.'"/>
<meta property="og:image" content="'.$imageSrc.'"/>
<meta property="og:image:width" content="200"/>
<meta property="og:image:height" content="200"/>
';
    foreach ($socials as $item) {
        $data['type']=$item;
        $dataStr = '';
        if(empty($data)){
            return'';
        }
        foreach ($data as $key => $dataItem) {
            $dataStr .= 'data-' . $key . '="' . $dataItem . '" ';
        }
        $itemStr = ${$item . 'Tpl'};
        $itemStr = str_replace('[+data+]', ' ' . $dataStr, $itemStr);
        $socialsStr .= $itemStr;

    }
}
$output =  str_replace('[+wrapper+]', $socialsStr, $wrapTpl);
$modx->setPlaceholder('share.form',$output);
$modx->setPlaceholder('share.og',$og);
?>