// JavaScript Document
function ChannelItem(idx, title, desc, img, mc) {
	this.idx = idx;
	this.title = title;
    this.desc = desc;
    this.img = img;
    this.mc = mc;
}

function Channels(kind) {
	this.kind = kind;
	this.channels = "";
	
	this.getChannelList = function(){
		if(this.channels == ""){
			//get list
			$.getJSON("/data_json/getChannelList/MV",function(data){
				console.log(data);
				
			});
			
		}
	}
};
