(async()=>{

    const {Tx} = Base;
    const json = await Tx('?page=1');
    console.log('json',json);

    /**
     * @property json.posts
     * @property post.post_date;
     */
    let max = '0000-00-00';
    json.posts.forEach((post)=>{
        if(max < post.post.post_date) max = post.post.post_date;
    });
    console.log('max-date',max);

})().then().catch();
