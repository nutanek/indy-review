import React from 'react'
import MainLayout from './../layouts/main'
import ToneSelector from './../components/toneSelector'
import Save from './../components/saveButton'
import { getTone, setTone } from './../services/tones'

export default class Tones extends React.Component {
    constructor() {
        super()
        this.state = {
            selected: 'pearl'
        }
    }

    componentDidMount() {
        // console.log(wpApiSettings.nonce)
        getTone().then(tone => {
            this.setState({
                selected: tone
            })
        }).catch()
    }

    selectTone(toneName) {
        this.setState({
            selected: toneName
        })
    }

    setTone() {
        // console.log(this.state.selected)
        setTone(this.state.selected).then((data) => {
            console.log(data)
        }).catch(err => {
            console.error(err)
        })
    }

    render() {
        const tones = ['charcoal', 'pearl'];

        return (
            <MainLayout>
                <div className="card">
                    <div className="card-header">
                        <div className="row">
                            <div className="col-6">
                                <h4><i className="fa fa-eyedropper"></i> <b>Tones</b></h4>
                            </div>
                            <div className="col-6 text-right">
                                <Save action={this.setTone.bind(this)}/>
                            </div>
                        </div>
                    </div>
                    <div className="card-body">
                        <div className="row justify-content-center">
                            {
                                tones.map((tone, key) =>
                                    <ToneSelector 
                                        key={key}
                                        style={tone}
                                        selected={this.state.selected===tone}
                                        select={this.selectTone.bind(this)} />
                                )
                            }
                        </div>
                    </div>
                </div>
            </MainLayout>
        )
    }
}