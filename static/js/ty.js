/*动态标题*/
var OriginTitile = document.title,
titleTime;
document.addEventListener("visibilitychange",
function() {
if (document.hidden) {
document.title = "👀跑哪里去了～";
clearTimeout(titleTime)
} else {
document.title = "🐖抓到你啦～" ;
titleTime = setTimeout(function() {
document.title = OriginTitile
},
2000)
}
});
