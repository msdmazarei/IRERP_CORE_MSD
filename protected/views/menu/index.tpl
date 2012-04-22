{literal}
isc.RestDataSource.create({
    ID:"menuItemsDS",
    fields:
        [
            {name:"Id",primaryKey:"true",type:"integer", hidden:"true"},
            {name:"IconPath",type:"string",title:"شمایل", length:1500, type:'image', imageURLPrefix:"{/literal}{$imageURLPrefix}{literal}"},
            {name:"Title",type:"string",title:"عنوان"},
            {name:"Command",type:"string",title:"فرمان",length:500, hidden:"true"},
            {name:"ParentId", type:"integer", title:"منوی پدر", hidden:"true"},
        ],
    dataFormat:"json",
    operationBindings:[
     {operationType:"fetch", dataProtocol:"getParams"},
     {operationType:"add", dataProtocol:"postParams"},
     {operationType:"remove", dataProtocol:"postParams", requestProperties:{httpMethod:"DELETE"}},
     {operationType:"update", dataProtocol:"postParams", requestProperties:{httpMethod:"PUT"}}
    ],
    {/literal}
    fetchDataURL :"{$this->baseUrl}/{$this->uniqueId}/",
    addDataURL   :"{$this->baseUrl}/{$this->uniqueId}/",
    updateDataURL:"{$this->baseUrl}/{$this->uniqueId}/",
    removeDataURL:"{$this->baseUrl}/{$this->uniqueId}/"
});

{literal}
var mainMenuCriteria = {
    criteria:{ fieldName:"ParentId", operator:"isNull", value:""}
};
var submenusCritera = {
    criteria:{ fieldName:"ParentId", operator:"equals", value:""}
}

window.gholirec = null;

isc.TileGrid.create({
    autoDraw: true,
    ID: "MenuItems",
    tileWidth: 150,
    tileHeight: 150,
    height: 400,
    width: "100%",
    showAllRecords: true,
    dataSource: "menuItemsDS",
    autoFetchData: true,
    animateTileChange: true,
    initialCriteria: mainMenuCriteria,
    recordDoubleClick: function(viewer, tile, record) {
    	if (record.IsSubmenu) {
	    	crit.criteria.value = record.Id;
	        MenuItems.fetchData(crit);
        }
    },
});

{/literal}
