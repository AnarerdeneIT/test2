document.addEventListener("DOMContentLoaded", () => {
  var val = document.getElementById("contain").childElementCount;
  var array = [];
  for (var i = 0; i < val; i++) {
    var obj = document.getElementById("dom" + i);
    var number = parseInt(obj.textContent);
    array.push(number);
  }
  array.reverse();
  val--;
  var k = array.length - 1;
  var timecount = 0;
  if (k != -1) $("#container").hide();
  $("#ylagch").hide();
  for (let j = k; j >= 0; j--) {
    setTimeout(() => {
      animate(j);
    }, (k - j) * 1000);
    if (j == 0) timecount = (k - j) * 1000 + 1000;
  }
  if (k != -1) {
    setTimeout(() => {
      $("#container").show();
      $("#ylagch").show();
    }, timecount);
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
    return true;
  }
});
