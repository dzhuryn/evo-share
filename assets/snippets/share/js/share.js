/**
 * Created by admin on 27.02.2017.
 */
$('body').on('click','a.share',function(e){
    e.preventDefault()
    var obj =$(this)

    var  title=obj.data('title')
    var description=obj.data('description')
    var uri=obj.data('uri')
    var poster=obj.data('poster')
    var type=$(this).data('type')

    if(type==   'tw'){
        url  = 'http://twitter.com/share?';
        url += 'text='      + encodeURIComponent(title+description);
        url += '&url='      + encodeURIComponent(uri);
        url += '&counturl=' + encodeURIComponent(uri);
    }
    if(type=='ok'){
        url  = 'https://connect.ok.ru/offer?';
        url += 'url='    + encodeURIComponent(uri)
    }

    if(type=='vk'){
        url  = 'http://vk.com/share.php?';
        url += 'url='          + encodeURIComponent(uri);
        url += '&title='       + encodeURIComponent(title);
        url += '&description=' + encodeURIComponent(description);
        url += '&image='       + encodeURIComponent(poster);
        url += '&noparse=true';
    }
    else if(type=='fb'){
        url  = 'http://www.facebook.com/sharer.php?s=100';
        url += '&p[title]='     + encodeURIComponent(title);
        url += '&p[summary]='   + encodeURIComponent(description);
        url += '&p[url]='       + encodeURIComponent(uri);
        url += '&p[images][0]=' + encodeURIComponent(poster);
    }
    else if(type='goo'){
        url  = 'https://plus.google.com/share?';
        url += 'url='          + encodeURIComponent(uri);
        url += '&title='       + encodeURIComponent(title);
    }
    else if(type=='pt'){

    }

    console.log(url)
    window.open(url,'','toolbar=0,status=0,width=626,height=436');
})