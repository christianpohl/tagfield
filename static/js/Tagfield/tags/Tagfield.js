pimcore.registerNS("pimcore.object.tags.Tagfield");

pimcore.object.tags.Tagfield = Class.create(pimcore.object.tags.input, {
  type: "Tagfield",

  initialize: function (data, fieldConf) {
    this.data = data;
    this.fieldConfig = fieldConf;
  },

  getLayoutEdit: function () {
    var store = new Ext.data.JsonStore({
      autoDestroy: true,
      baseParams: {
        key: this.fieldConfig.tagskey
      },
      autoSave: false,
      url: '/plugin/Tagfield/admin/getTags',
      root: 'data',
      fields: ['value']
    });

    store.load();

    return this.component = new Ext.ux.form.SuperBoxSelect({
      allowBlank: true,
      autoSave: false,
      autoDestroy: true,
      queryDelay: 100,
      triggerAction: 'all',
      resizable: true,
      mode: 'local',
      width: this.fieldConfig.width,
      minChars: 2,
      fieldLabel: this.fieldConfig.title,
      name: this.fieldConfig.name,
      value: this.data,
      emptyText: t("superselectbox_empty_text"),
      store: store,
      fields: ['value'],
      displayField: 'value',
      valueField: 'value',
      allowAddNewData: true,
      listeners: {
        newitem: function (bs, v, f) {
          bs.addNewItem({
            value: v
          });
        }
      }
    });
  }
});
