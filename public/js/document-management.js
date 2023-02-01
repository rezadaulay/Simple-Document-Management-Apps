const signingImageElementWrapper = document.querySelector("#signing_image_wrapper");
const signingManualElementWrapper = document.querySelector("#signing_manual_wrapper");
const signingImageElement = document.querySelector("#signing_image");
const signingManualPadElement = document.querySelector("#signing_manual_pad");
const signaturePad = new SignaturePad(signingManualPadElement);

if (document.querySelector("#signing_manual").value !== '') {
    signaturePad.fromDataURL(document.querySelector("#signing_manual").value, {ratio: 1})
}

signaturePad.addEventListener("endStroke", () => {
    document.querySelector("#signing_manual").value = signaturePad.toDataURL()
}, { once: false });

function chooseSigningType (type) {
    clearSignature()
    if (type === 'upload') {
        signingImageElementWrapper.style.display = "block"
        signingImageElement.required = true
        signingManualElementWrapper.style.display = "none"
    } else {
        signingImageElementWrapper.style.display = "none"
        signingImageElement.required = false
        signingManualElementWrapper.style.display = "block"
    }
}

function clearSignature () {
    signaturePad.clear()
    document.querySelector("#signing_manual").value = ''
    document.querySelector("#signing_image").value = ''
}