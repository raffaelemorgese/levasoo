function validateAll(form,classId){
//  console.log($(form).find(classId).each(function(){alertify.alert(this.value.trim());}));
    var isFilled=true;
    $(form).find(classId).each(function(){
        isFilled = isFilled & (this.value.trim()!='');
//      console.log(isFilled);
    });
    !isFilled && alertify.alert('Attenzione: tutti i campi devono essere compilati.');
    return Boolean(isFilled);
};

