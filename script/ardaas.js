document.addEventListener("DOMContentLoaded", () => {
  var val = document.getElementById("contain").childElementCount;
  var array = [];
  for (var i = 0; i < val; i++) {
    var obj = document.getElementById("dom" + i);
    var number = parseInt(obj.textContent);
    array.push(number);
  }
  array.reverse();
  for (let i = array.length - 1; i >= 0; i--) {
    setTimeout(() => {
      animate(i);
    }, i * 1000);
  }
  function animate(value) {
    var result = 0;
    var time = setInterval(function () {
      result++;
      document.getElementById("dom" + value).innerHTML = result;
      if (result >= 10) {
        document.getElementById("dom" + value).innerHTML = array[value];
        clearInterval(time);
      }
    }, 100);
  }
});
