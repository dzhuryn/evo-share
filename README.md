#evo-share 
Це сніппет для генеації форми шарингу в соц мережах, а також мета тегів Open Graph Protocol

#### Приклад використання

    [!share?
        &imageTvs=`images,category`
        &defaultImage=`/theme/img/default.jpg`
    !]
    [+share.og+]
    [+share.form+]
#### Результат

    <meta property="og:title" content="1"/>
    <meta property="og:description" content="3"/>
    <meta property="og:image" content="http://share.loc/images/desert.jpg"/>
    <meta property="og:image:width" content="200"/>
    <meta property="og:image:height" content="200"/>
    
    <a class="share" href="#"  data-title="1" data-description="3" data-uri="http://share.loc/" data-poster="http://share.loc/images/desert.jpg" data-type="fb" >fb<i class="spring-ico-facebook"></i></a>
    <a class="share" href="#"  data-title="1" data-description="3" data-uri="http://share.loc/" data-poster="http://share.loc/images/desert.jpg" data-type="tw" >tw<i class="spring-ico-twitter"></i></a>
    <a class="share" href="#"  data-title="1" data-description="3" data-uri="http://share.loc/" data-poster="http://share.loc/images/desert.jpg" data-type="vk" >vk<i class="spring-ico-vk"></i></a>
    
### Параметри
    noJS не використувати js код (1/0) за умовчуванням 1
    wrapTpl шаблон обертки
    fbTpl  шаблон ссилки шарингу соц мережі fb  //'<a class="share" href="#" [+data+]>fb<i class="ico-facebook"></i></a>
    twTpl шаблон ссилки шарингу соц мережі tw
    ptTpl шаблон ссилки шарингу соц мережі pinterest
    vkTpl шаблон ссилки шарингу соц мережі vk
    gooTpl шаблон ссилки шарингу соц мережі google plus
    imageTvs список тв, де буде шукатись карртинка
    defaultImage картинка по умолчанию (логотип)
    socials список соц мереж, доступно (fb,vk,pt,tw)



* Сніппет підтримує bLang для мультимовного шарингу
* Пошук картинок в тв полях, підтримка multiTV
* Картинка по заумовчуванню
