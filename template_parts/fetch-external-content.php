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
        'options'   => '',
        'sort_order'   => '',
        'site_id'   => '',
    )
);

$url = $args['url'];
$type = $args['type'];
$options = $args['options'];
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

    const siteId = '<?php echo $site_id ?>'
    const type = '<?php echo $type ?>'
    const contentId = '<?php echo $content_id ?>'
    const options = '<?php echo $options ?>'
    const sortOrder = '<?php echo $sort_order ?>'.replaceAll(' ', '').split(',');
    // const allUrls = <?php echo json_encode($allUrls) ?>;
    const researchGroups = <?php echo json_encode($research_groups) ?>;

    if ( type === 'team' ) {
        fetch(`<?php echo $url; ?>/wp-json/wp/v2/${options}`)
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

            // Fetch All Projects

            const projectPromises = [];

            allProjectUrls = researchGroups.map( ({ url }) => `${url}/wp-json/wp/v2/${options}`)

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

            const researchGroupData = {
                projects: allProjects,
                categories: allCategories
            }

            switch (type) {
                case 'research':    
                    createSelectedProject( researchGroupData );
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
                        imageUrl: teamMember['_embedded']['wp:featuredmedia'][0]['media_details'].sizes.medium.source_url || '',
                        additionalContent: teamMember.acf['tile_content'] || '',
                        url: teamMember.link || '',
                    }

                    console.log( teamMember );

                    content = `
                        <div class="uzhsl-tile uzhsl-tile-team" data-href="${params.url}">
                            <div class="uzhsl-tile-wrapper">
                                <div class="tile__image uzhsl-tile-image uzhsl-tile-image-thumbnail"><img src="${params.imageUrl}"/></div>
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
                    additionalContent: project.acf['tile_content'] || '',
                    url: project.link || '',
                    categories: getCategoryButtons( categories, project.categories, selectedProject ) || ''
                }

                // getCategoryButtons( )

                content = `
                    <div class="uzhsl-tile uzhsl-tile-project" data-href="${params.url}">
                        <div class="uzhsl-tile-wrapper">
                            <div class="tile__image uzhsl-tile-image uzhsl-tile-image-thumbnail"><img src="${params.imageUrl}"/></div>
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

</script>
