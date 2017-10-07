import React from 'react'
import styled from 'styled-components'
import { Redirect } from 'react-router-dom';

export default class SidebarMenu extends React.Component {
    constructor(props) {
        super(props)
        this.state = {
            redirect: false,
            isCurrentPage: false
        }
    }

    componentDidMount() {
        let currentPage = this.isCurrentPage(window.location.hash)
        this.setState({
            currentPage: currentPage
        })
    }

    isCurrentPage(page) {
        let currentPage = page.replace("#/", "")
        if (currentPage == this.props.link) {
            return true
        }
        return false
    }

    handleOnClick(event) {
        this.setState({redirect: true})
    }

    render() {
        let { title, icon, link, selected } = this.props

        if (this.state.redirect) {
            return <Redirect push to={ '/' + link } />
        }

        const Menu = styled.div`
            color: #ffffff;
            font-size: 1.3em;
            padding-top: 10px;
            padding-bottom: 10px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            .icon {
                margin-left: 20px;
                margin-right: 10px;
                -moz-transition: all 0.3s;
                -webkit-transition: all 0.3s;
                transition: all 0.3s;
            }
            &.-selected {
                color: #E08283;
            }
            &:hover {
                cursor: pointer;
                color: #E08283;
            }
            &:hover .icon {
                -moz-transform: scale(1.8) translateX(-5px);
                -webkit-transform: scale(1.8) translateX(-5px);
                transform: scale(1.8) translateX(-5px);
            }
        `;

        return (
            <Menu className={this.state.currentPage ? 'row -selected' : 'row'} 
                onClick={()=>this.handleOnClick()}>
                <div className="col-1 icon d-block d-md-none d-lg-block">
                    <i className={'fa fa-' + icon}></i>
                </div>
                <div className="col">
                    {title}
                </div> 
            </Menu>
        )
    }
}