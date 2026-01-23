const validationForm = document.querySelector(".validationForm");
const patternElems = document.querySelectorAll(".pattern");

validationForm.addEventListener("submit", (e) => {
  const errorElems = e.currentTarget.querySelectorAll(".error");
  errorElems.forEach((elem) => {
    elem.remove();
  });

  patternElems.forEach((elem) => {
    let dataPattern = elem.getAttribute("data-pattern");
    let pattern;
    let errorMessage = "入力された形式が正しくないようです。";

    if (dataPattern) {
      switch (dataPattern) {
        case "tel":
          pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
          errorMessage =
            "電話番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。";
          break;
        case "fax":
          pattern = /^[0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4}$/;
          errorMessage =
            "FAX番号の形式が正しくありません。ハイフンありで数字10桁を入力してください。";
          break;
        case "mail":
          pattern = /^[a-zA-Z0-9_.+-]+[@][a-zA-Z0-9.-]+$/;
          errorMessage =
            "メールアドレスの形式が正しくありません。正しい形で入力してください。";
          break;
        case "zip":
          pattern = /^[0-9]{7}$/;
          errorMessage =
            "郵便番号の形式が正しくありません。ハイフンなしで7桁の数字を入力してください。";
          break;
        case "year":
          pattern = /^(19|20)\d{2}$/;
          errorMessage =
            "年度の形式が正しくありません。4桁の数字で西暦を入力してください。";
          break;
        default:
          pattern = new RegExp(dataPattern);
      }
    }

    if (elem.value.trim() !== "" && !pattern.test(elem.value)) {
      createError(elem, errorMessage);
      e.preventDefault();
    }
  });
});

const createError = (elem, errorMessage) => {
  const errorSpan = document.createElement("span");
  errorSpan.classList.add("error");
  errorSpan.setAttribute("aria-live", "polite");
  errorSpan.textContent = errorMessage;
  elem.parentNode.appendChild(errorSpan);
};
