function getSpecificIdForSoldModal(ref) {
    var visibleId = $(ref).parents(".input-group").find("input[type=text]").prop("id");
    var hiddenId = $(ref).parents(".input-group").find("input[type=hidden]").prop("id");
    console.log('visibleId: '+visibleId+' hiddenId: '+hiddenId)
    return { visibleId, hiddenId }
}







