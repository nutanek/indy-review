import React from 'react'
import MainLayout from './../layouts/main'
import ToneSelector from './../components/toneSelector'
import Save from './../components/saveButton'

export default class Tones extends React.Component {
    constructor() {
        super()
        this.state = {
            selected: 'pearl'
        }
    }

    selectTone(toneName) {
        this.setState({
            selected: toneName
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
                                <Save></Save>
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