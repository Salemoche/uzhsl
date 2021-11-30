<?php
/**
*========================================
*	
*	External Content Script
*
*   @package HaselNamespace
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
    )
);

$url = $args['url'];
$type = $args['type'];
$options = $args['options'];
$content_id = $args['content_id'];
$sort_order = $args['sort_order'];

$allUrls = [];

foreach (get_field('research_groups', 'option') as $research_group) {
    array_push($allUrls, $research_group['url']);
}

?>

<script>

    const type = '<?php echo $type ?>'
    const contentId = '<?php echo $content_id ?>'
    const options = '<?php echo $options ?>'
    const sortOrder = '<?php echo $sort_order ?>'.replaceAll(' ', '').split(',');
    const allUrls = <?php echo json_encode($allUrls) ?>;

    if ( type === 'team' ) {
        fetch(`<?php echo $url; ?>/wp-json/wp/v2/${options}`)
            .then(response => response.json())
            .then(data => {
                createTeamMembers( data )
            });
    } else {

        Promise.all([
            // allUrls.map(url => {fetch(`${url}/wp-json/wp/v2/${options}`)})
            fetch( `${allUrls[0]}/wp-json/wp/v2/${options}`),
            fetch( 'https://jsonplaceholder.typicode.com/posts' ),
        ]).then(function (responses) {
            return Promise.all(responses.map(function (response) {
                return response.json();
            }));
        }).then(function (data) {
            if ( type === 'research' ) {
                createSelectedProject( data )
            }
        })
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
                        <div class="hsl-tile hsl-tile-team" data-href="${params.url}">
                            <div class="hsl-tile-wrapper">
                                <div class="tile__image hsl-tile-image hsl-tile-image-thumbnail"><img src="${params.imageUrl}"/></div>
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

    function createSelectedProject( projects ) {

        const selectedProjects = <?php echo json_encode($sort_order) ?>;

        let allProjects = [];

        projects.forEach(project => {
            allProjects = [...allProjects, ...project];
        });


        selectedProjects.forEach( selectedProject => {
            allProjects.forEach( project => {
                let content = '';

                if ( project.slug !== selectedProject['project_name'] || !project.link.includes(selectedProject['site_id']) ) return

                params = {
                    name: project.title.rendered || '',
                    position: project.acf.position || '',
                    email: '',
                    room: '',
                    imageUrl: project['_embedded']['wp:featuredmedia'][0]['media_details'].sizes.medium.source_url || '',
                    additionalContent: project.acf['tile_content'] || '',
                    url: project.link || '',
                }

                console.log( project );

                content = `
                    <div class="hsl-tile hsl-tile-project" data-href="${params.url}">
                        <div class="hsl-tile-wrapper">
                            <div class="tile__image hsl-tile-image hsl-tile-image-thumbnail"><img src="${params.imageUrl}"/></div>
                            <div class="tile__content">
                                <h5 class="tile__title">${params.name}</h5>
                                <div class="tile__position">${params.position}</div>
                                <div class="tile__additional-content">${params.additionalContent}</div>
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

</script>
