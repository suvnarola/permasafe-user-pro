jQuery.fn.sortElements = (function(){
var sort = [].sort;
return function(comparator, getSortable){
	getSortable = getSortable || function(){return this;};
	var placements = this.map(function(){
		var sortElement = getSortable.call(this),parentNode = sortElement.parentNode,nextSibling = parentNode.insertBefore(document.createTextNode(''),sortElement.nextSibling);
		return function(){
			if (parentNode === this)
				throw new Error("You can't sort elements if any one is a descendant of another.");
			parentNode.insertBefore(this, nextSibling);
			parentNode.removeChild(nextSibling);
		};
	});
	return sort.call(this, comparator).each(function(i){
		placements[i].call(getSortable.call(this));
	});
};
})();

(function(jQuery){
jQuery.fn.jsRapTable = function(options){
	
return this.each(function(){
	this.opt = jQuery.extend({
		sort:{index:0,up:false},
		onSort:null
	},options);
	let base = this;
	let ths = null;
	let thd = null;
    let startOffset = 0;
	let startWidth = 0;
	jQuery(this).addClass('rapTable');
	jQuery('th',this).each(function(){
		let th = this;
		jQuery('<span>').appendTo(th);
		th.addEventListener('click', function(e){
			let i = jQuery(th).index();
			let u = jQuery(th).hasClass('darr');
			base.Sort(i,u);
		});
	});
	jQuery('td:not(:last-child)',this).each(function(){
		let td = this;
		let grip = jQuery('<div>').addClass('grip').appendTo(jQuery(this))[0];
		grip.addEventListener('mousedown', function(e){
			let i = jQuery(td).index();
			ths = jQuery('th',base).eq(i);
			thd = jQuery('th',base).eq(++i);
			startOffset = e.clientX;
			startWidth = jQuery(ths).width();
			e.stopPropagation();
        });
		grip.addEventListener('click',function (e){
			e.stopPropagation();
		});
	});
	document.addEventListener('mousemove',function (e) {
		jQuery('tbody tr',base).css({cursor:'w-resize'});
		if(ths && thd){
			let ows = jQuery(ths).width();
			let owd = jQuery(thd).width();
			let ow = ows + owd;
			let dw = e.clientX - startOffset + startWidth - ows;
			if(ows + dw < 3)
				dw = 3 - ows;
			if(owd - dw < 3)
				dw = owd - 3;
			jQuery(ths).width(ows + dw);
			jQuery(thd).width(owd - dw);
			if(dw > 0)
				jQuery(ths).width(ow - jQuery(thd).width());
			else
				jQuery(thd).width(ow - jQuery(ths).width());
		}else
			jQuery('tbody tr',base).css({cursor:'pointer'});
	});
	document.addEventListener('mouseup',function(e){
			ths = null;
			thd = null;
			e.stopPropagation();
	});
	
	this.Sort = function(i,u){
		if(!this.opt.onSort)return;
		jQuery('.uarr').removeClass('uarr');
		jQuery('.darr').removeClass('darr');
		if(u)
			jQuery('th',this).eq(i).addClass('uarr');
		else
			jQuery('th',this).eq(i).addClass('darr');
		this.opt.onSort.call(this,i,u);
	}
	
	this.Sort(this.opt.sort.index,this.opt.sort.up);
});

}})(jQuery);