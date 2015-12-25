interface Loadable {
    instance:any;
    maps?: {};
    objs?: {};
    data?: {};
    create:(maps:{}, objs:{}, data:{}) => {};
}