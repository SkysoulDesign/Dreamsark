interface Tweenable {
    duration:number,
    destination:any,
    origin?:any,
    delay?:number|boolean,
    start?: () => void,
    update:(el:any) => void,
    complete?: () => void,
    overshoot?:number,
    autoStart?:boolean
}