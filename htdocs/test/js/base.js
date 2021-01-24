const Base = {
    host: '/test/api.php',

    /**
     * Tx
     * @param api
     * @param data
     * @param method
     * @returns {Promise<any|Object>}
     */
    async Tx(api,data,method){
        const opts = {
            headers: {
                'Content-Type': 'application/json'
            },
            method: 'GET'
        };
        if(data){
            opts.method = 'POST';
            opts.body = JSON.stringify(data)
        }
        if(method) opts.method = method;
        let res;
        let status;
        try {
            const url = api.startsWith('http') || api.startsWith('/') ? api : Base.host+''+api;
            res = await fetch(url,opts);
            status = res.status;
            res = await res.text();
            const json = JSON.parse(res);
            if([200,201].indexOf(status) < 0) json.err = status;
            if(typeof json !== 'object') return {ok:false,message:json};
            return json;
        }
        catch(error){
            return {ok:false,err:status,message:error+'',res,status};
        }
    },
};

Base.Tx.post = async(url,body) => {
    return await Base.Tx(url,body);
};
Base.Tx.put = async(url,body) => {
    return await Base.Tx(url,body,'PUT');
};
Base.Tx.patch = async(url,body) => {
    return await Base.Tx(url,body,'PATCH');
};
Base.Tx.delete = async(url) => {
    return await Base.Tx(url,null,'DELETE');
};
