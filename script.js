const nav = document.querySelector("nav");
const navWrapper = document.querySelector("#nav-wrapper");
const placeholder = document.getElementById("nav-placeholder")
console.log(placeholder)

function updateHeader() {
  // 54vh + 12px - (12vh + 8px) = 42vh + 4px
  let scrollRatio = (window.innerHeight*41/100 + 8 - window.scrollY)/(window.innerHeight*41/100 + 8);
  scrollRatio = scrollRatio<=0?0:scrollRatio;
  navWrapper.style.setProperty("--scrollRatio", `${scrollRatio}`);
}

placeholder.style.height = "var(--nav-placeholder-height)"
updateHeader();
window.addEventListener("scroll", updateHeader);
