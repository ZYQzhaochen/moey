VanillaTilt.init(document.querySelectorAll(".card"),{
  max: 15,
  speed: 20,
  glare: true,
  "max-glare": 0
})
function get_hitokoto(){
    $.getJSON("/jsapi.php", function (result) { //获取文件上传大小等
        $("#text").html(result.text);
    })
}