<?php
/**
*========================================
*	
*	External Content Script
*
*   @package UZHSLNamespace
*
*========================================*/

$args = wp_parse_args(
    $args,
    array(
        'content_id'   => '',
        'url'   => [],
        'type'   => '',
        // 'options'   => '',
        'sort_order'   => '',
        'site_id'   => '',
    )
);

$url = $args['url'];
$type = $args['type'];
// $options = $args['options'];
$content_id = $args['content_id'];
$sort_order = $args['sort_order'];
$site_id = $args['site_id'];
$research_groups = get_field('research_groups', 'option');

// $allUrls = [];

// foreach ($research_groups as $research_group) {
//     array_push($allUrls, $research_group['url']);
// }

?>

<script>

    (function () {
        const siteId = '<?php echo $site_id ?>'
        const type = '<?php echo $type ?>'
        const contentId = '<?php echo $content_id ?>'
        // const options = '< ?php echo $options ?>'
        const sortOrder = '<?php echo $sort_order ?>'.replaceAll(' ', '').split(',');
        // const allUrls = <?php echo json_encode($allUrls) ?>;
        const researchGroups = <?php echo json_encode($research_groups) ?>;

        if ( type === 'team' ) {
            fetch(`<?php echo $url; ?>/wp-json/wp/v2/team?_embed`)
                .then(response => response.json())
                .then(data => {
                    createTeamMembers( data )
                });
        } else {

            // Promise.all([
            //     // allUrls.map(url => {fetch(`${url}/wp-json/wp/v2/${options}`)})
            //     fetch( `${allUrls[0]}/wp-json/wp/v2/${options}`),
            //     fetch( 'https://jsonplaceholder.typicode.com/posts' ),
            // ]).then(function (responses) {
            //     return Promise.all(responses.map(function (response) {
            //         return response.json();
            //     }));
            // }).then(function (data) {
            //     if ( type === 'research' ) {
            //         createSelectedProject( data )
            //     }
            // })

            // console.log (allUrls)

            async function newPromise (url) {
                let response = await fetch( url );
                return await response.json();
            }

            (async () => {

                console.log('fetching');

                // Fetch All Projects

                const projectPromises = [];

                allProjectUrls = researchGroups.map( ({ url }) => `${url}/wp-json/wp/v2/project?_embed`)

                allProjectUrls.forEach(url => {
                    projectPromises.push( newPromise(url) )
                });

                const projects = await Promise.all( projectPromises )
                let allProjects = []

                projects.forEach(project => {
                    allProjects = [...allProjects, ...project];
                });

                // Fetch All Categories

                const categoryPromises = [];

                const allCategoryUrls = researchGroups.map( researchGroup => `${researchGroup.url}/wp-json/wp/v2/categories`);

                allCategoryUrls.forEach(url => {
                    categoryPromises.push( newPromise(url) )
                });

                const categories = await Promise.all( categoryPromises );
                let allCategories = []

                categories.forEach(category => {
                    allCategories = [...allCategories, ...category];
                });

                // Fetch All Publications

                const publicationPromises = [];

                const allPublicationUrls = researchGroups.map( researchGroup => `${researchGroup.url}/wp-json/wp/v2/publication?_embed`);

                allPublicationUrls.forEach(url => {
                    publicationPromises.push( newPromise(url) )
                });

                const publications = await Promise.all( publicationPromises );
                let allPublications = []

                publications.forEach(publication => {
                    allPublications = [...allPublications, ...publication];
                });

                const researchGroupData = {
                    projects: allProjects,
                    publications: allPublications,
                    categories: allCategories,
                }

                switch (type) {
                    case 'research':    
                        createSelectedProject( researchGroupData );
                        break;
                    case 'publication':    
                        createPublicationSlider( researchGroupData );
                        break;
                }
                
            })()
        }

        function createTeamMembers( teamMembers ) {
            sortOrder.forEach( orderItem => {
                teamMembers.forEach( teamMember => {
                    let content = '';

                    if ( teamMember.slug === orderItem ) {

                        params = {
                            name: teamMember.title.rendered || '',
                            position: teamMember.acf.position || '',
                            email: '',
                            room: '',
                            imageUrl: teamMember['_embedded']['wp:featuredmedia'] ? teamMember['_embedded']['wp:featuredmedia'][0]['media_details'].sizes.medium.source_url : '',
                            altText: teamMember['_embedded']['wp:featuredmedia'] ? teamMember['_embedded']['wp:featuredmedia'][0]['alt_text'] : '',
                            additionalContent: teamMember.acf['tile_content'] || '',
                            url: teamMember.link || '',
                        }

                        console.log( teamMember );

                        content = `
                            <div class="uzhsl-tile uzhsl-tile-team" data-href="${params.url}">
                                <div class="uzhsl-tile-wrapper">
                                    <div class="tile__image uzhsl-tile-image uzhsl-tile-image-thumbnail"><img src="${params.imageUrl}" alt="${params.altText}"/></div>
                                    <div class="tile__content">
                                        <h5 class="tile__title">${params.name}</h5>
                                        <div class="tile__position">${params.position}</div>
                                        <div class="tile__additional-content">${params.additionalContent}</div>
                                    </div>
                                </div>
                            </div>
                        `
                        document.querySelector(`#${contentId}`).append(stringToHTML(content));
                    }
                })
            })

            window.salemoche.setSizes();
            window.salemoche.addEventListeners();

        }

        function createSelectedProject({ projects, categories }) {

            const selectedProjects = <?php echo json_encode($sort_order) ?>;

            // console.log(selectedProjects)

            selectedProjects.forEach( selectedProject => {
                projects.forEach( project => {
                    let content = '';

                    if ( project.slug !== selectedProject['project_name'] || !project.link.includes(selectedProject['site_id']) ) return

                    params = {
                        name: project.title.rendered || '',
                        position: project.acf.position || '',
                        email: '',
                        room: '',
                        imageUrl: project['_embedded']['wp:featuredmedia'] ? project['_embedded']['wp:featuredmedia'][0]['media_details'].sizes.medium.source_url : '',
                        altText: project['_embedded']['wp:featuredmedia'] ? project['_embedded']['wp:featuredmedia'][0]['alt_text'] : '',
                        additionalContent: project.acf['tile_content'] || '',
                        url: project.link || '',
                        categories: getCategoryButtons( categories, project.categories, selectedProject ) || ''
                    }

                    // getCategoryButtons( )

                    content = `
                        <div class="uzhsl-tile uzhsl-tile-project" data-href="${params.url}">
                            <div class="uzhsl-tile-wrapper">
                                <div class="tile__image uzhsl-tile-image uzhsl-tile-image-thumbnail"><img src="${params.imageUrl}" alt="${params.altText}"/></div>
                                <div class="tile__content">
                                    <h5 class="tile__title">${params.name}</h5>
                                    <div class="tile__position">${params.position}</div>
                                    <div class="tile__additional-content">${params.additionalContent}</div>
                                    <div class="tile__tags uzhsl-tags">
                                        ${params.categories}
                                    </div>
                                </div>
                            </div>
                        </div>
                    `
                    document.querySelector(`#${contentId}`).append(stringToHTML(content));

                })
            })

            window.salemoche.setSizes();
            window.salemoche.addEventListeners();

        }

        function createPublicationSlider({ publications, categories }) {

            const selectedPublications = <?php echo json_encode($sort_order) ?>;
            let content = '';
            
            selectedPublications.forEach( selectedPublication => {
                publications.forEach( (publication, i) => {
                    
                    // console.log(selectedPublication['publication_name'], publication.slug)

                    if ( publication.slug !== selectedPublication['publication_name'] || !publication.link.includes(selectedPublication['site_id']) ) return

                    params = {
                        name: publication.title.rendered || '',
                        excerpt: publication.excerpt.rendered || '',
                        imageUrl: publication['_embedded']['wp:featuredmedia'] ? publication['_embedded']['wp:featuredmedia'][0]['media_details'].sizes.medium.source_url : '',
                        altText: publication['_embedded']['wp:featuredmedia'] ? publication['_embedded']['wp:featuredmedia'][0]['alt_text'] : '',
                        additionalContent: publication.acf['tile_content'] || '',
                        url: publication.link || '',
                        categories: getCategoryButtons( categories, publication.categories, selectedPublication ) || ''
                    }


                    content = `
                        <div class="swiper-slide swiper-slide${i}">
                            <div class="uzhsl-slide uzhsl-slide-publication">
                                <section class="uzhsl-section uzhsl-section-standard uzhsl-section-card">
                                    <div class="uzhsl-section-wrapper sm-block">
                                        <div class="uzhsl-column uzhsl-column-left sm-col sm-large-5 sm-medium-6">
                                            <div class="section__media section__image uzhsl-image" height: 241.052px;">
                                                <img src="${params.imageUrl}" class="attachment-large size-large" alt="${params.altText}">        
                                            </div>
                                        </div>
                                        <div class="uzhsl-column uzhsl-column-right sm-col sm-large-6 sm-medium-6 ">            
                                            <h3 class="section__title">${params.name}</h3>
                                            <div class="section__text">${params.excerpt}</div>
                                            <div class="section__link-container">
                                                <a class="section__link uzhsl-button" href="${params.url}">
                                                    <span>read more</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    `;
                    console.log(params.name)
                    
                    document.querySelector(`#${contentId}`).append(stringToHTML(content));
                })
            })
            
            // console.log(stringToHTML(content))
            document.querySelector(`#${contentId}`).append(stringToHTML(content));
            console.log(document.querySelector(`#${contentId}`))

            window.salemoche.setSizes();
            window.salemoche.addEventListeners();
            window.salemoche.initializeSwiper();
        }

        function getCategoryButtons ( allCategories, categoryIds, selectedProject ) {

            let buttonString = '';
            const siteId = selectedProject['site_id'];
            const url = selectedProject;

            
            const siteCategories = allCategories.filter( category => {
                return category.link.toLowerCase().includes(siteId)
            })

            siteCategories.forEach( category => {

                if ( categoryIds.includes(category.id) ) {
                    const siteUrl = category.link.replace(`/category/${category.slug}/`, '')
                    buttonString += `<div class="uzhsl-button uzhsl-button--small uzhsl-tag ${category.siteId}" data-name="${category.name}" data-href="${siteUrl}"><span> ${category.name}</span></div>`
                }
            })


            return buttonString

        }

        const support = (function () {
            if (!window.DOMParser) return false;
            var parser = new DOMParser();
            try {
                parser.parseFromString('x', 'text/html');
            } catch(err) {
                return false;
            }
            return true;
        })();

        function stringToHTML (str) {
            if (support) {
                var parser = new DOMParser();
                var doc = parser.parseFromString(str, 'text/html');
                return doc.body.childNodes[0];
            }

            var dom = document.createElement('div');
            dom.innerHTML = str;
            return dom;
        };

        function getCategories( fetchUrl, id ) {

            const categories = [];

            fetch(`${fetchUrl}/wp-json/wp/v2/categories`)
                .then(response => response.json())
                .then(data => {
                    data.filter( category => {
                        return category.id === id
                    })

                    console.log( data )
                });
        }
    })()

</script>


<!-- <div class="uzhsl-slider swiper">
    <div class="swiper-wrapper">
    < ?php foreach ($slides as $slide) :?>
        <div class="swiper-slide">
        < ?php if ( $type === 'publication') : ?>
            <div class="uzhsl-slide uzhsl-slide-publication">
                < ?php createStandardBlock($slide, 'card') ?>
            </div>
        < ?php elseif ( $type === 'image') : ?>
            <div class="uzhsl-slide uzhsl-slide-image">
                < ?php echo wp_get_attachment_image($slide, 'large'); ?>
            </div>
        < ?php endif; ?>
        </div>
        < ?php endforeach; ?>
    </div>
    <div class="swiper-pagination"></div>
</div> -->