export default {
   mounted(el, binding) {
        //console.log(binding)
        const options = {
            rootMargin: '0px',
            threshold: 1.0
        }
        const callback = (entries, observer) => {
            /* Content excerpted, show below */
            if (entries[0].isIntersecting) {
                //this.loadMorePosts();
                binding.value(); // вызываем переданную функцию
            }
        };

        // observer - объект, содаваемый на основе 'callback'
        const observer = new IntersectionObserver(callback, options);
        // говорим обзерверу за каким элементом следить ($refs.observer)
        observer.observe(el);
   },
   name: 'intersection'
}