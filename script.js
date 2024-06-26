const nav = document.querySelector("nav");
const navWrapper = document.querySelector("#nav-wrapper");
const placeholder = document.getElementById("nav-placeholder")
const date = 1715796569009;
console.log(placeholder)

function updateHeader() {
  // 54vh + 12px - (12vh + 8px) = 42vh + 4px
  let scrollRatio = (window.innerHeight*41/100 + 8 - window.scrollY)/(window.innerHeight*41/100 + 8);
  scrollRatio = scrollRatio<=0?0:scrollRatio;
  navWrapper.style.setProperty("--scrollRatio", `${scrollRatio}`);
}
function onResize () {
  updateHeader();
  let height = getComputedStyle(navWrapper).getPropertyValue("--nav-placeholder-height");
  placeholder.style.height = height;
  console.log(height)
}
function fun() {
  if (window.location.host === "catmajor.github.io") return;
  else {
    document.body.style.opacity = `${1 -  (Date.now()-date)/157680000000}`;
    setTimeout(fun, 100);
  }
}

onResize();
updateHeader();
fun();
window.addEventListener("scroll", updateHeader);
window.addEventListener("resize", onResize);