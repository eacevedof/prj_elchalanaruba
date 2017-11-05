const fnNcp = require("ncp").ncp
const oPath = require("path")

fnNcp.limit = 16;

const sPathStatic = oPath.join(__dirname,"../build")
const sPathDestiny = oPath.join(__dirname,"../../the_public")
const fnOncopy = (oErr)=>{
    if(oErr) return console.error(oErr)
    console.log("done")
}
console.log(sPathDestiny,sPathStatic)
fnNcp(sPathStatic, sPathDestiny, fnOncopy);