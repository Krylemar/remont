//main index func
function redirectToPage(table,page) {
	window.location.href = table+"/"+page+".php";
};

//sub-index func
function redirectToSubPageWithId(page,id) {
	window.location.href = page+".php?id="+id;
};

function redirectToSubPageRelative(page) {
	window.location.href = page+".php";
};

function redirectToMainPage(){
	window.location.href = "../index.php";
}
